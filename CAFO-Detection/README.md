A🛰️ Automated Detection of CAFOs Using Deep Learning & Computer Vision
Welcome to my CAFO (Concentrated Animal Feeding Operations) detection project using deep learning and aerial imagery. This project combines the power of image classification and object detection to identify CAFOs for environmental monitoring and regulatory use.

📌 Overview
This project leverages two deep learning pipelines:

📘 Image Classification using MobileNetV3 — SagarProject.ipynb

📗 Object Detection using YOLOv8 — YOLO.ipynb

Both models provide complementary insight into the aerial imagery and enhance robustness in CAFO detection.

🧠 Project Breakdown
📘 SagarProject.ipynb – MobileNetV3 Image Classification
Trained a Convolutional Neural Network (CNN) to classify aerial images into CAFO or Non-CAFO using MobileNetV3.

✅ Steps Implemented:

📂 Dataset path: /content/drive/MyDrive/Dataset/cafo_model_training_data

📦 Unzipped .tar.gz aerial image archives

🧹 Preprocessed & normalized images with OpenCV and TensorFlow

🧠 Fine-tuned MobileNetV3 (pre-trained on ImageNet)

⚙️ Data Augmentation, Early Stopping & Hyperparameter Tuning

📈 Evaluated model: AUC-ROC, F1-score, Recall, Precision

💾 Saved model as MobileNetV3.h5

📸 Generated inference predictions and saved to: /yolov8-CAFOS/inference/

📤 Outputs:

✅ MobileNetV3.h5 classification model

📊 Accuracy metrics and confusion matrix

🖼️ Test images with predicted class labels

📗 YOLO.ipynb – YOLOv8 Object Detection
This notebook uses YOLOv8 to detect CAFOs using bounding boxes in high-res aerial imagery.

✅ Steps Implemented:

🧾 YAML Config: /data/cafo.yaml

🏷️ Labels (YOLO format): /split_by_class/

🔁 CSV → YOLO conversion for bounding boxes

✂️ Train/Val/Test data split

🧠 Trained YOLOv8 model from scratch

💾 Saved best weights: best.pt

🖼️ Detected bounding boxes with confidence scores

💾 Saved results: /yolov8-CAFOS/inference/

📤 Outputs:

✅ best.pt YOLOv8 detection model

📸 Images with bounding boxes + class predictions

📈 mAP, Precision, and Recall scores

🖼️ Dataset
📥 CAFO Training Dataset from Stanford RegLab

🌍 Source: Aerial imagery from North Carolina

📁 Size: 21,768+ high-resolution images

📄 Annotations: Classification CSV + YOLO-style bounding boxes


🧰 Technologies Used

Languages: Python

Frameworks: TensorFlow, Keras, YOLOv8

Libraries: OpenCV, NumPy, Pandas, Matplotlib, scikit-learn

Tools: Google Colab, Jupyter Notebooks, Git


## 📊 Results Comparison

| Model       | Approach             | Output Type      | Evaluation Metrics                       |
|-------------|----------------------|------------------|------------------------------------------|
| MobileNetV3 | Image Classification | CAFO vs Non-CAFO | Accuracy, AUC-ROC, F1-score, Recall      |
| YOLOv8      | Object Detection     | Bounding Boxes   | mAP, Precision, Recall, Confidence Score |

 

🖼️ Sample Visuals

Below are examples of prediction results from the two models:




**MobileNetV3 Classification Output:**

<img src="https://github.com/cusagar/Project-Portfolio/blob/main/CAFO-Detection/north-carolina_avery_187_287_6_1_0_17_-331_13881.jpeg?raw=true" width="400" alt="MobileNetV3 Prediction">

**YOLOv8 Detection Output:**

<img src="https://github.com/cusagar/Project-Portfolio/blob/main/CAFO-Detection/north-carolina_catawba_6427_287_6_1_0_17_-70_13765.jpeg?raw=true" width="400" alt="YOLOv8 Detection">



🙌 Acknowledgements

Dataset credit: Stanford RegLab

Project developed as part of my graduate research in computer vision and deep learning

👤 Author

Umanandan Sagar Chukka📧 Email: sagarus2022@gmail.com🔗 

