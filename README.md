# 🏥 Jio Health - Booking Module (Chức năng Đặt lịch khám)

## Giới thiệu dự án
Đây là một phần trong dự án Phân tích và Phát triển hệ thống nền tảng y tế **Jio Health**. Module này tập trung giải quyết bài toán đặt lịch khám thông minh, hỗ trợ tối ưu hóa quy trình tiếp nhận bệnh nhân thông qua hai hình thức: **Khám tại phòng khám** và **Khám trực tuyến (Online)**.

Dự án được phát triển dựa trên sự kết hợp giữa tư duy phân tích nghiệp vụ (**Business Analysis**) và năng lực triển khai kỹ thuật thực tế.

---

## Công nghệ sử dụng
* **Frontend:** HTML5, CSS3, JavaScript.
* **Backend:** PHP (Xử lý logic đặt lịch và điều phối dữ liệu).
* **Database:** MySQL (Quản lý hồ sơ bệnh nhân và lịch hẹn).
* **Integrations:** Google Meet API (Tự động tạo link hội thoại cho hình thức khám Online).

---

## Tính năng chính
Dựa trên luồng nghiệp vụ đã được chuẩn hóa qua các tài liệu phân tích:
1.  **Quản lý danh sách lịch khám:** Theo dõi trực quan mã lịch, dịch vụ, thời gian và trạng thái thanh toán.
2.  **Đặt lịch linh hoạt:**
    * Tùy chọn linh hoạt hồ sơ bệnh nhân, dịch vụ chuyên khoa và bác sĩ phụ trách.
    * **Khám tại phòng khám:** Hệ thống tự động cấp **Số thứ tự khám (STT)** giúp giảm thời gian chờ đợi.
    * **Khám trực tuyến:** Tự động tạo và cung cấp **Link Google Meet** ngay sau khi đặt lịch thành công.
3.  **Xác nhận và Thanh toán:** Cơ chế kiểm tra thông tin chi tiết lịch hẹn và chi phí trước khi lưu vào hệ thống để đảm bảo tính chính xác.

---

## Hướng dẫn sử dụng
Người dùng có thể thực hiện đặt lịch theo các bước sau:

1.  **Truy cập:** Tại giao diện chính, chọn tính năng **+ Đặt Lịch**.
2.  **Thông tin cơ bản:** Lựa chọn hồ sơ bệnh nhân cần khám và hình thức khám mong muốn.
3.  **Chi tiết dịch vụ:** Chọn dịch vụ, bác sĩ chuyên khoa, ngày khám và khung giờ còn trống.
4.  **Xác nhận:** Kiểm tra bảng "Chi tiết lịch khám" và nhấn **Xác nhận**.
5.  **Hoàn tất:**
    * *Khám Online:* Nhấn **Tham gia ngay** để kết nối với bác sĩ qua Google Meet.
    * *Khám tại chỗ:* Sử dụng **Số thứ tự** được cấp để làm thủ tục tại quầy tiếp đón.
