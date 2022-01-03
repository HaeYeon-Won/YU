"""
- Project : Detect car license-plate test 
- 지정된 이미지를 사용하여 차량 번호판을 조회하는 프로그램
- Author : Hae-Yeon-Won
- Date of last update : 2021.12.27.
"""
import cv2
import numpy as np
import pytesseract
import time
import math
import collections

#자동차 번호판에 사용되는 한글
symbol=[
    '가', '나', '다', '라', '마','거', '너',
     '더', '러', '머', '버', '서', '어', '저',
    '고', '노', '도', '로', '모', '보', '소', '오', '조',
    '구', '누', '두', '루', '무', '부', '수', '우', '주',
    '아', '바', '사', '자', '배', '하', '허', '호', '국', '합', '육', '해', '공']


def convert(img, pos):  
    """
    yolov3로 학습한 번호판 모델로부터 image와 번호판의 좌표를 받아옴.
    이후 좌표를 바탕으로 번호판 이미지를 잘라옴 + 평평하게 조정
    """
    pts1 = np.float32(pos)

    # 변환 후 영상에 사용할 서류의 폭과 높이 계산 ---③ 
    w1 = abs(pos[1][0] - pos[0][0])    # 상단 좌우 좌표간의 거리
    w2 = abs(pos[2][0] - pos[3][0])         # 하당 좌우 좌표간의 거리
    h1 = abs(pos[1][1] - pos[2][1])      # 우측 상하 좌표간의 거리
    h2 = abs(pos[0][1] - pos[3][1])        # 좌측 상하 좌표간의 거리
    #print(w1, w2, h1, h2)
    width = max([w1, w2])                       # 두 좌우 거리간의 최대값이 서류의 폭
    height = max([h1, h2])                      # 두 상하 거리간의 최대값이 서류의 높이
    
    # 변환 후 4개 좌표
    pts2 = np.float32([[0,0], [width-1,0], 
                        [width-1,height-1], [0,height-1]])

    # 변환 행렬 계산 
    mtrx = cv2.getPerspectiveTransform(pts1, pts2)
    # 원근 변환 적용
    result = cv2.warpPerspective(img, mtrx, (width, height))
    return result

def extractLicensePlate(img):
    """
    Yolo V3로 학습시킨 가중치를 바탕으로 받아온 이미지에서
    번호판 영역 추출
    """
    net = cv2.dnn.readNet("yolov3_last2.weights", "yolov3.cfg")  #가중치 파일 불러오기
    classes = []
    with open("obj.names", "r") as f:
        classes = [line.strip() for line in f.readlines()]
    layer_names = net.getLayerNames()
    output_layers = [layer_names[i-1] for i in net.getUnconnectedOutLayers()]
    colors = np.random.uniform(0, 255, size=(len(classes), 3))
    
    img = cv2.resize(img, None, fx=0.4, fy=0.4)
    height, width, channels = img.shape #이미지의 높이, 너비, 채녈을 로드

    """
    네트워크에서 이미지를 바로 사용할 수 없기 때문에 Blob로 변환
    Blob는 이미지에서 특징을 잡아내고 크기를 조정하는데 사용.
    YOLO가 허용하는 세가지 크기
    320 x 320 : 작고 정확도는 떨어지지 만 속도 빠름
    416 x 416 : 중간
    609 x 609 : 정확도는 더 높지만 속도 느림
    """
    blob = cv2.dnn.blobFromImage(img, 0.00392, (416, 416), (0, 0, 0), True, crop=False)  
    temp_ext_img = img
    net.setInput(blob)
    outs = net.forward(output_layers)


    #신뢰도, 신뢰 임계값 계산
    #만약 신뢰도가 0.5 이상이면 문체가 감지되었다고 간주.
    class_ids = []
    confidences = []
    boxes = []
    for out in outs:
        for detection in out:
            scores = detection[5:]
            class_id = np.argmax(scores) 
            confidence = scores[class_id]
            if confidence > 0.5:
                # Object detected
                center_x = int(detection[0] * width)
                center_y = int(detection[1] * height)
                w = int(detection[2] * width)
                h = int(detection[3] * height)
                # 좌표
                x = int(center_x - w / 2)
                y = int(center_y - h / 2)
                boxes.append([x, y, w, h])
                confidences.append(float(confidence))
                class_ids.append(class_id)
    indexes = cv2.dnn.NMSBoxes(boxes, confidences, 0.5, 0.4) #노이즈 제거

    #처리한 결과를 화면에 표시하는 부분
    font = cv2.FONT_HERSHEY_PLAIN
    for i in range(len(boxes)):
        if i in indexes:
            x, y, w, h = boxes[i]
            label = str(classes[class_ids[i]])
            color=(0,0,255)
            cv2.rectangle(img, (x, y), (x + w, y + h), color, 2)
            #cv2.putText(img, label, (x, y + 30), font, 3, color, 3)
    # cv2.imshow("Detect license-plate", img)
    # cv2.waitKey()
    # cv2.destroyAllWindows()
    try:
        #번호판을 정확히 잡아온 경우
        #만약 좌표가 음수인 경우 양수로 변환
        x, y, w, h=abs(x),abs(y),abs(w),abs(h)
    except UnboundLocalError:
        #번호판을 읽어오지 못한 경우
        #원본 사이즈로 설정
        x,y,w,h=0,0,416,416
    pos1 = [x, y] #Left Up
    pos2 = [x+w, y] #Right Up
    pos3 = [x+w, y+h] #Right Down
    pos4 = [x, y+h] #Left Down
    src=np.array([pos1, pos2, pos3, pos4])
    img=convert(temp_ext_img, src) #계산한 좌표를 토대로 이미지를 처리
    return img

def ApplyGaussianBlur(img):
    """
    번호판 영역의 이미지만 잘라온 후 이미지의 인식률 향상을 위해
    GaussianBlur 처리
    """

    height, width, channel = img.shape  #높이 ,너비, 채널을 받아옴

    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY) #컬러 이미지를 Gray 이미지로 변경

    structuringElement = cv2.getStructuringElement(cv2.MORPH_RECT, (3, 3)) #엣지 검출을 위한 커널 행렬 설정(모양, 크기)

    #모폴로지 연산, (원본배열, 연산방법, 커널) 경계선을 검출하기 위한 사전 작업
    # tophat = 원본 - 열림(침식 + 팽창) : 밝은 영역 강조
    # blackhat = 닫힘(팽창 + 침식) - 원본 : 어두운 부분 강조
    imgTopHat = cv2.morphologyEx(gray, cv2.MORPH_TOPHAT, structuringElement) 
    imgBlackHat = cv2.morphologyEx(gray, cv2.MORPH_BLACKHAT, structuringElement)

    #tophat, blackhat 적용
    imgGrayscalePlusTopHat = cv2.add(gray, imgTopHat)
    gray = cv2.subtract(imgGrayscalePlusTopHat, imgBlackHat)
    img_blurred = cv2.GaussianBlur(gray, ksize=(5, 5), sigmaX=0) # 가우시안 블러 적용, 윤곽선을 더 잘 잡을 수 있도록 한다.

    img_thresh = cv2.adaptiveThreshold(
       img_blurred, 
       maxValue=255.0, 
       adaptiveMethod=cv2.ADAPTIVE_THRESH_GAUSSIAN_C, 
       thresholdType=cv2.THRESH_BINARY_INV, 
       blockSize=19,  # 픽셀 사이즈
       C=9 # 보정 상수
    )# Threshold 문턱값, adaptiveThreshold는 광원에도 효과적으로 엣지 추출

    return img_thresh # 처리한 이미지를 반환

def is_validChar(chars, result):
    global symbol
    index=0
    back=0
    back_count=0
    result_chars=[]
    chars.strip()
    #print(chars)
    for c in chars: #받아온 문자열에서 차량 번호일 가능성이 있는 문자를 골라오는 과정
            if (c in symbol) or c.isdigit(): # 숫자이거나 차량 번호판에 사용되는 문자라면 저장
                if back_count==4: #번호판 뒷 4자리가 전부 저장된 경우 탐색 종료
                    break
                result_chars.append(c)
                if back==1:# 뒷자리 시작
                    back_count+=1
                if not c.isdigit(): # 만약 차량에 사용되는 한글이 나온경우
                    index=result_chars.index(c)
                    back=1 # 자동차 뒷자리를 읽어오도록 함
    part1=result_chars[0:index] # 자동차 번호판 한글 앞부분
    part2=result_chars[index+1:len(result_chars)] # 자동차 번호판 한글 뒷부분

    if len(part1)==3: 
        """
        만약 앞자리가 세자리라면 번호판 테두리를 숫자로 인식했다고 판단
        뒤에 두자리만 잘라옴
        """
        index-=1
        part1=result_chars[1:index+1] 
        result_chars=result_chars[1:]
    #print(result_chars)
    #print()
    if len(part1)==2 and len(part2)==4:
        """
        위 과정을 거쳐 정상적인 차량 번호라고 판단된다면 해당번호 return
        """
        s=''.join(result_chars)
        #반복적으로 이미지에서 번호를 읽어와서 해당 번호가 얼마만큼 감지되었는지 표시
        if s in result:
            result[s]+=1
        else:
            result[s]=0
    #print("Detect Number = ", result)
    return result

def is_validNum(img):
    count=10 # 원본 이미지, GaussianBlur 처리한 이미지 별로 10번씩 반복 탐색
    L=[-5,-4,-3,-2,-1,0,1,2,3,4,5] #시행마다 회전시킬 각도
    result={}
    org_image= extractLicensePlate(img) # 원본이미지를 잘라옴
    # cv2.imshow("Cut Picture", org_image)
    # cv2.waitKey()
    # cv2.destroyAllWindows()
    gaussian_image=ApplyGaussianBlur(org_image) #GaussianBlur 처리한 이미지
    # cv2.imshow("Apply GaussianBlu", gaussian_image)
    # cv2.waitKey()
    # cv2.destroyAllWindows()
    for i in range(count+1):
        img_thresh=org_image
        #print("angle = ", L[i])

        #원본 이미지의 각도를 -5도~5도사이로 회전시키면서 탐색
        height, width, channel = img_thresh.shape
        matrix = cv2.getRotationMatrix2D((width/2, height/2), L[i], 1) # 사진의 중앙 기준 회전변환 한 행렬을 반환
        dst = cv2.warpAffine(img_thresh, matrix, (width, height)) #위에서 회전변환을 통해 만든 아핀 맵 행렬을 적용하고 출력 이미지 크기 조정
        # cv2.imshow("Angle Changed", dst)
        # cv2.waitKey()
        # cv2.destroyAllWindows()
        chars=pytesseract.image_to_string(dst, lang='kor', config='--psm 7 --oem 3') #tesseract를 통해 변환된 이미지에서 str을 읽어옴
        result=is_validChar(chars, result) #읽어온 문자열이 타당한 번호인지 판단
    for i in range(count+1):
        img_thresh=gaussian_image
        #print("angle = ", L[i])                 
        # 원본 이미지의 각도를 -5도~5도사이로 회전시키면서 탐색                                                                             
        height, width= img_thresh.shape
        matrix = cv2.getRotationMatrix2D((width/2, height/2), L[i], 1) # 사진의 중앙 기준 회전변환 한 행렬을 반환
        dst = cv2.warpAffine(img_thresh, matrix, (width, height)) #위에서 회전변환을 통해 만든 아핀 맵 행렬을 적용하고 출력 이미지 크기 조정
        # cv2.imshow("Angle Changed", dst)
        # cv2.waitKey()
        # cv2.destroyAllWindows()
        chars=pytesseract.image_to_string(dst, lang='kor', config='--psm 7 --oem 3') #tesseract를 통해 변환된 이미지에서 str을 읽어옴
        result=is_validChar(chars, result) #읽어온 문자열이 타당한 번호인지 판단
    print("result = ",result)

    if len(result)!=0:
        return max(result, key=result.get) # 가장많이 탐색된 차량번호를 반환
    else:
        return False # 만약 감지된 차량번호가 없다면 False 반환


path = "이미지 저장"
img = cv2.imread(path)
is_validNum(img)

 
