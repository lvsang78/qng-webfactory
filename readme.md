# QNG WebFactory

QNG WebFactory là nền tảng mẫu (factory) dùng để xây dựng, chuẩn hóa và triển khai các website WordPress theo một quy trình có thể tái sử dụng.

Mục tiêu của dự án là tạo ra một nền tảng WordPress có cấu trúc rõ ràng, dễ bảo trì, có thể mở rộng và có thể sử dụng AI/Copilot để hỗ trợ phát triển mà vẫn giữ quyền kiểm soát kiến trúc và mã nguồn ở phía developer.

---

## 1. Mục tiêu

QNG WebFactory hướng tới việc chuẩn hóa quy trình:

```text
Requirement
    ↓
Design / Architecture
    ↓
Development
    ↓
Validation
    ↓
Git
    ↓
Deployment
```

Một website mới không nên được xây dựng lại từ đầu nếu các thành phần có thể tái sử dụng.

Factory sẽ từng bước cung cấp:

* Custom WordPress Theme.
* Reusable Block Patterns.
* Template Parts.
* Reusable WordPress Plugins.
* Development environment.
* Git workflow.
* Automated validation.
* CI/CD.
* Deployment conventions.

---

## 2. Nguyên tắc kiến trúc

QNG WebFactory phân tách rõ trách nhiệm:

```text
WordPress Core
    │
    ├── Theme
    │     └── Presentation / Layout / FSE
    │
    ├── Plugin
    │     └── Business / Functionality
    │
    └── Infrastructure
          └── Docker / Database / Deployment
```

### WordPress Core

Không chỉnh sửa trực tiếp WordPress Core.

### Theme

Theme chịu trách nhiệm chủ yếu về:

* Layout.
* Presentation.
* Templates.
* Template Parts.
* Block Patterns.
* Global Styles.
* `theme.json`.

QNG WebFactory ưu tiên WordPress Full Site Editing (FSE) và Core Blocks.

### Plugin

Plugin chịu trách nhiệm về:

* Business logic.
* Custom functionality.
* Integration.
* API.
* Data processing.
* Các chức năng không thuộc presentation layer.

### Infrastructure

Infrastructure chịu trách nhiệm về:

* Docker.
* Database.
* Environment.
* Deployment.
* CI/CD.

---

## 3. AI / Copilot Development

QNG WebFactory được thiết kế để có thể sử dụng AI/Copilot trong quá trình phát triển.

AI không thay thế developer trong các quyết định quan trọng về:

* Architecture.
* Security.
* Database.
* Production.
* Data safety.
* Source code ownership.

Workflow mặc định:

```text
Requirement
    ↓
Inspect
    ↓
Analyze
    ↓
Explain / Plan
    ↓
Implement
    ↓
Validate
    ↓
Review Diff
    ↓
Git
```

Các quy tắc chi tiết dành cho AI được định nghĩa trong:

`AGENTS.md`

---

## 4. Repository Structure

Cấu trúc repository sẽ được phát triển dần theo nhu cầu thực tế.

Hiện tại repository chứa môi trường WordPress local và các thành phần nền tảng ban đầu.

Các thành phần chính:

```text
QNG-WebFactory/
│
├── AGENTS.md
├── README.md
├── .gitignore
├── docker-compose.yml
│
├── plugins/
├── themes/
│
└── ...
```

Không tạo trước các module hoặc folder chỉ để làm cho kiến trúc "có vẻ đầy đủ".

Cấu trúc mới chỉ được bổ sung khi có requirement hoặc use case thực tế.

---

## 5. Local Development

### Requirements

Môi trường phát triển hiện tại:

* Windows 11.
* Docker Desktop.
* Git.
* GitHub.
* Visual Studio Code.
* GitHub Copilot.
* Web browser.

### Start environment

Từ thư mục project:

```powershell
cd D:\QNG-WebFactory
docker compose up -d
```

Kiểm tra container:

```powershell
docker compose ps
```

WordPress local:

```text
http://localhost:8080
```

### Stop environment

```powershell
docker compose stop
```

Start lại:

```powershell
docker compose start
```

---

## 6. Docker Architecture

Môi trường local hiện tại gồm:

```text
Browser
   │
   ▼
WordPress
   │
   ▼
MariaDB
```

Docker Compose quản lý các service:

```text
wordpress
    │
    └── db
```

Các volume database và WordPress được Docker quản lý.

Không thực hiện các thao tác xóa volume hoặc reset database nếu chưa xác định rõ mục đích và ảnh hưởng dữ liệu.

---

## 7. Git Workflow

Repository sử dụng Git và GitHub.

Branch chính hiện tại:

```text
main
```

Các thay đổi cần được kiểm tra trước khi commit:

```powershell
git status
git diff
```

Không commit:

* Secret.
* Credentials.
* File tạm.
* Build artifact không cần thiết.
* File generated không cần thiết.

Không tự động commit, push, merge hoặc tạo Pull Request nếu chưa có yêu cầu hoặc workflow được phê duyệt phù hợp.

---

## 8. Environment

QNG WebFactory phân biệt:

```text
Local
Development
Staging
Production
```

Configuration và secret không được hard-code vào source code.

Các thông tin nhạy cảm phải được quản lý thông qua cơ chế configuration/secret phù hợp với từng environment.

---

## 9. Production Direction

Production stack hiện được định hướng theo:

```text
Linux
+
Nginx hoặc Apache
+
WordPress
+
Database
+
GitHub Actions
```

Đây là định hướng hiện tại, chưa phải quyết định production architecture cuối cùng.

Production architecture sẽ được quyết định riêng trước khi triển khai production thực tế.

---

## 10. Quality

Validation được thực hiện theo phạm vi thay đổi.

Ví dụ:

### Theme

* PHP syntax nếu có PHP.
* Theme activation.
* Browser validation.
* Responsive validation.
* Browser console.

### Plugin

* PHP syntax.
* Plugin activation.
* Functional validation.
* Security validation phù hợp.

### Docker

* Compose configuration.
* Container startup.
* Service connectivity.
* Persistence khi có liên quan.

### Documentation

* Markdown.
* Nội dung.
* Git diff.

Không phải mọi task đều cần chạy toàn bộ test.

---

## 11. Security

Không commit:

* Password.
* API key.
* Access token.
* Refresh token.
* Private key.
* Database credentials.
* Production credentials.

Nếu phát hiện secret đã xuất hiện trong Git history:

1. Dừng push liên quan.
2. Không in secret ra log hoặc báo cáo.
3. Xác định loại secret và vị trí.
4. Đề nghị revoke/rotate.
5. Đánh giá Git history.
6. Xác định phương án xử lý trước khi tiếp tục.

---

## 12. Database

Database changes phải xem xét:

* Schema impact.
* Data impact.
* Compatibility.
* Backup.
* Recovery.
* Rollback strategy.

Các thao tác destructive như:

```text
DROP
TRUNCATE
DELETE lớn
Destructive ALTER
Database reset
Volume deletion
```

được xem là thao tác rủi ro cao và phải được kiểm soát theo `AGENTS.md`.

---

## 13. Documentation

Các tài liệu quan trọng của project:

| File                 | Mục đích                                |
| -------------------- | --------------------------------------- |
| `README.md`          | Giới thiệu và hướng dẫn sử dụng project |
| `AGENTS.md`          | Quy tắc cho AI/Copilot Agent            |
| `docker-compose.yml` | Local infrastructure                    |
| `.gitignore`         | Kiểm soát file không đưa vào Git        |

Các tài liệu kỹ thuật chi tiết sẽ được bổ sung khi project phát triển.

---

## 14. Roadmap

QNG WebFactory sẽ được phát triển theo từng giai đoạn:

```text
Repository Foundation
        ↓
Custom QNG Block Theme
        ↓
QNG Core Plugin
        ↓
Reusable Components
        ↓
Testing / Quality Gates
        ↓
CI/CD
        ↓
Deployment
        ↓
Website Factory Workflow
```

Mục tiêu cuối cùng là có thể tạo một website WordPress mới từ các thành phần chuẩn hóa thay vì bắt đầu lại từ đầu.

---

## 15. Project Status

Current status:

* Git repository: Ready
* GitHub repository: Ready
* Docker environment: Ready
* WordPress local environment: Ready
* MariaDB: Ready
* AI development rules: Ready
* `.gitignore`: Ready
* README: Ready
* Custom QNG Theme: Planned
* QNG Core Plugin: Planned
* CI/CD: Planned

---

## 16. License

License will be defined when the project reaches a reusable/distributable release stage.
