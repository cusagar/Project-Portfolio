# 🛰️ Automated Detection of CAFOs Using Deep Learning & Computer Vision

Welcome to my **CAFO (Concentrated Animal Feeding Operations)** detection project using deep learning and aerial imagery.  
This project combines the power of **image classification** and **object detection** to identify CAFOs for environmental monitoring and regulatory use.

---

## 📌 Overview

This project leverages two deep learning pipelines:

- 📘 **Image Classification** using `MobileNetV3` — `SagarProject.ipynb`
- 📗 **Object Detection** using `YOLOv8` — `YOLO.ipynb`

Each model provides a different angle on evaluating aerial images and contributes toward robust CAFO detection.

---

## 🧠 Project Breakdown

### 📘 SagarProject.ipynb – MobileNetV3 Image Classification

Trains a **CNN (Convolutional Neural Network)** to classify aerial images into **CAFO** or **Non-CAFO**.

**Steps Implemented:**

- 📂 Dataset: `/content/drive/MyDrive/Dataset/cafo_model_training_data`
- 📦 Unzipped `.tar.gz` image archives
- 🧹 Preprocessing with TensorFlow & OpenCV
- 🧠 Fine-tuned MobileNetV3 pretrained on ImageNet
- 🔁 Data Augmentation and Hyperparameter Tuning
- 📈 Evaluation: AUC-ROC, F1-score, Precision, Recall
- 💾 Saved model as `MobileNetV3.h5`
- 🖼️ Inference images saved to: `/yolov8-CAFOS/inference/`

**Outputs:**

- ✅ `MobileNetV3.h5` classification model
- 📊 Accuracy metrics and confusion matrix
- 🖼️ Labeled test images

---

### 📗 YOLO.ipynb – YOLOv8 Object Detection

This notebook applies YOLOv8 to detect and localize CAFOs in aerial images using **bounding boxes**.

**Steps Implemented:**

- 🔧 Dataset config YAML: `/data/cafo.yaml`
- 🏷️ Labels from: `/split_by_class/`
- 🔁 Converted CSV labels to YOLO format
- ✂️ Split into train, val, and test sets
- 🧠 Trained YOLOv8 from scratch
- 💾 Saved best weights as `best.pt`
- 🖼️ Inferred bounding boxes on test images
- 📤 Visual results saved to: `/yolov8-CAFOS/inference/`

**Outputs:**

- ✅ `best.pt` trained YOLOv8 model
- 📸 Prediction visuals with bounding boxes
- 📈 mAP, Precision, and Recall

---

## 📥 Dataset

**📌 [CAFO Training Dataset (Stanford RegLab)](https://reglab.stanford.edu/data/cafo-training-dataset/)**

- 🌎 Source: Aerial imagery of North Carolina
- 🖼️ Images: 21,768+ high-resolution images
- 🗂️ Labels: Classification CSV + bounding boxes

---

## 🧰 Technologies Used

- **Languages:** Python  
- **Frameworks:** TensorFlow, Keras, YOLOv8  
- **Libraries:** OpenCV, NumPy, Pandas, Matplotlib, scikit-learn  
- **Tools:** Google Colab, Git, Jupyter Notebooks  

---

## 📊 Results Comparison

| Model       | Approach             | Output Type      | Evaluation Metrics                       |
|-------------|----------------------|------------------|------------------------------------------|
| MobileNetV3 | Image Classification | CAFO vs Non-CAFO | Accuracy, AUC-ROC, F1-score, Recall      |
| YOLOv8      | Object Detection     | Bounding Boxes   | mAP, Precision, Recall, Confidence Score |

---

## 🖼️ Sample Visuals

**MobileNetV3 Classification Output:**  
<img src="https://github.com/cusagar/Project-Portfolio/blob/main/CAFO-Detection/north-carolina_avery_187_287_6_1_0_17_-331_13881.jpeg?raw=true" width="400" alt="MobileNetV3 Prediction">

**YOLOv8 Detection Output:**  
<img src="https://github.com/cusagar/Project-Portfolio/blob/main/CAFO-Detection/north-carolina_catawba_6427_287_6_1_0_17_-70_13765.jpeg?raw=true" width="400" alt="YOLOv8 Detection">

---

## 🙌 Acknowledgements

- 🗂️ Dataset credit: [Stanford RegLab](https://reglab.stanford.edu)
- 📚 Developed as part of my graduate research in Computer Vision & Deep Learning

---

## 👤 Author

**Umanandan Sagar Chukka**  
📧 Email: [sagarus2022@gmail.com](mailto:sagarus2022@gmail.com)  
🔗 LinkedIn: *Insert your LinkedIn*  
💻 GitHub: *Insert your GitHub*

