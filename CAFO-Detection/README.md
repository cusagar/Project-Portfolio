Automated Detection of CAFOs Using Deep Learning & Computer Vision 🛰️

Welcome to my CAFO (Concentrated Animal Feeding Operations) detection project using deep learning and aerial imagery. This project combines the power of image classification and object detection to identify CAFOs for environmental monitoring and regulatory use.

📌 Overview

This project leverages two deep learning approaches:

Image Classification using MobileNetV3 (SagarProject.ipynb)

Object Detection using YOLOv8 (YOLO.ipynb)

Each model provides a unique method for evaluating aerial images and contributes toward robust CAFO detection.

🧠 Project Breakdown

📘 SagarProject.ipynb – Image Classification using MobileNetV3

This notebook focuses on training a convolutional neural network to classify aerial images as CAFO or non-CAFO.

Steps Implemented:

Dataset located in Google Drive at: /content/drive/MyDrive/Dataset/cafo_model_training_data

Extracted and unzipped .tar.gz image archives.

Processed and normalized images using TensorFlow and OpenCV.

Constructed a CNN using MobileNetV3 (pretrained on ImageNet).

Fine-tuned the model using training data with data augmentation techniques.

Evaluated model accuracy using Precision, Recall, F1-score, and AUC-ROC.

Saved the trained model as an .h5 file.

Ran inference on test images and stored classified output in /content/drive/MyDrive/yolov8-CAFOS/inference/.

Output:

MobileNetV3.h5 classification model (available upon request)

Accuracy scores and confusion matrix

Folder containing test images with predicted class labels

📗 YOLO.ipynb – Object Detection using YOLOv8

This notebook handles spatial detection using bounding boxes, training a YOLOv8 model on labeled aerial data.

Steps Implemented:

Dataset YAML config: /content/drive/MyDrive/yolov8-CAFOS/data/cafo.yaml

Bounding box labels: /content/drive/MyDrive/yolov8-CAFOS/data/cafo_model_training_data/split_by_class/

Converted CSV annotations into YOLO format.

Split dataset into training, validation, and test sets.

Trained a YOLOv8 model from scratch.

Output the best model weights as best.pt.

Inferred on test images to generate bounding boxes with class labels and confidence scores.

Saved visual detection results to: /content/drive/MyDrive/yolov8-CAFOS/inference/

Output:

best.pt detection model (available upon request)

YOLO prediction images with bounding boxes and confidence values

Evaluation metrics: mAP, precision, recall

🖼️ Dataset

This project uses the official CAFO Training Dataset from Stanford RegLab.

Source: North Carolina aerial imagery

Size: 21,768+ labeled aerial images

Format: JPEG images + CSV labels for classification & bounding boxes

🧰 Technologies Used

Languages: Python

Frameworks: TensorFlow, Keras, YOLOv8

Libraries: OpenCV, NumPy, Pandas, Matplotlib, scikit-learn

Tools: Google Colab, Jupyter Notebooks, Git

📊 Results Comparison

Model

Approach

Output Type

Evaluation Metrics

MobileNetV3

Image Classification

CAFO vs Non-CAFO

Accuracy, AUC-ROC, F1-score, Recall

YOLOv8

Object Detection

Bounding Boxes

mAP, Precision, Recall, Confidence Score

 

🖼️ Sample Visuals

Below are examples of prediction results from the two models:

MobileNetV3 Classification Output:

<img src="https://github.com/cusagar/Project-Portfolio/blob/main/north-carolina_carteret_19027_287_6_1_0_18_-492_13402.jpeg?raw=true" width="150" alt="Umanandan Sagar Chukka">
 → classified as Poultry CAFOl

## 🖼️ Sample Visuals

**MobileNetV3 Classification Output:**

<img src="https://github.com/cusagar/Project-Portfolio/blob/main/CAFO-Detection/north-carolina_avery_187_287_6_1_0_17_-331_13881.jpeg?raw=true" width="400" alt="MobileNetV3 Prediction">

**YOLOv8 Detection Output:**

<img src="https://github.com/cusagar/Project-Portfolio/blob/main/CAFO-Detection/north-carolina_catawba_6427_287_6_1_0_17_-70_13765.jpeg?raw=true" width="400" alt="YOLOv8 Detection">


<img src="https://github.com/cusagar/Project-Portfolio/blob/main/north-carolina_carteret_19027_287_6_1_0_18_-492_13402.jpeg?raw=true" width="150" alt="Umanandan Sagar Chukka"> → correctly identified as notcafo

YOLOv8 Detection Output:

Bounding boxes drawn with class labels such as poultry_cafo_f and swine_cafo_fl

Confidence scores visualized on top of boxes

(Sample images and full visualizations available on request.)

🙌 Acknowledgements

Dataset credit: Stanford RegLab

Project developed as part of my graduate research in computer vision and deep learning

👤 Author

Umanandan Sagar Chukka📧 Email: sagarus2022@gmail.com🔗 LinkedIn: [Insert your LinkedIn]💻 GitHub: [Insert your GitHub]

