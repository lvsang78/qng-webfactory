Đây là bộ quy tắc bắt buộc dành cho AI Agent khi làm việc trong repository QNG WebFactory.

# Mục tiêu dự án

QNG WebFactory là nền tảng dùng để xây dựng website WordPress nhanh, có khả năng tái sử dụng, kiểm thử, quản lý mã nguồn và triển khai bằng quy trình chuẩn.

Mục tiêu:

Phát triển website nhanh.
Tái sử dụng theme, plugin, component và workflow.
Giữ code sạch, dễ hiểu và dễ bảo trì.
Kiểm soát bảo mật.
Có thể kiểm thử.
Quản lý mã nguồn bằng Git/GitHub.
Có khả năng triển khai lặp lại.
Sử dụng AI để tăng tốc phát triển nhưng con người vẫn kiểm soát kiến trúc và các quyết định quan trọng.

QNG WebFactory không chỉ là một project WordPress mẫu.

Nó phải trở thành một factory có khả năng tạo và duy trì nhiều website WordPress khác nhau.

# Nguyên tắc quan trọng nhất
Human controls AI

AI là công cụ hỗ trợ phát triển.

AI không phải là người quyết định cuối cùng về:

Kiến trúc.
Bảo mật.
Database.
Production.
Deployment.
Data migration.
Thay đổi công nghệ lớn.
Các thao tác có khả năng làm mất dữ liệu.

AI phải:

Đọc yêu cầu.
Kiểm tra repository.
Phân tích.
Đề xuất phương án.
Chờ human approval nếu thay đổi quan trọng.
Thực hiện.
Kiểm tra.
Báo cáo kết quả.

Không được tự ý thay đổi kiến trúc chỉ vì AI cho rằng đó là phương án tốt hơn.

# Technology Stack

Stack hiện tại:

OS: Windows 11
IDE: VS Code
AI: GitHub Copilot / Copilot Agent
Source Control: Git
Repository: GitHub Free
Local Runtime: Docker
Web Server: Apache thông qua WordPress Docker image
CMS: WordPress
Database: MariaDB
Theme: Custom WordPress Block Theme / Full Site Editing (FSE)
Plugin: Custom PHP Plugin
Browser: Chrome / Edge
Production: Linux + Nginx hoặc Apache
CI/CD: GitHub Actions

Không tự ý bổ sung framework, CMS, database hoặc công nghệ lớn khác nếu chưa có yêu cầu hoặc human approval.

# Kiến trúc tổng thể

Kiến trúc phải giữ sự phân tách rõ ràng:

WordPress Core
     |
     +----------------+
     |                |
   Plugin           Theme
     |                |
Business Logic    Presentation
     |
Data / API / Integration

Infrastructure
     |
     +-- Docker
     +-- Git / GitHub
     +-- CI/CD
     +-- Deployment

Nguyên tắc:

Theme     = Presentation
Plugin    = Functionality / Business Logic
Core      = WordPress Core
Docker    = Infrastructure
Git       = Source Control

# WordPress Core

Không được sửa WordPress Core.

Không được:

Chỉnh sửa file WordPress Core.
Đưa business logic vào Core.
Patch trực tiếp Core để giải quyết yêu cầu của project.

WordPress Core phải luôn có khả năng được nâng cấp hoặc thay thế.

# Theme

Theme chịu trách nhiệm chính về presentation.

Theme có thể chứa:

Layout.
Header.
Footer.
Navigation.
Templates.
Template Parts.
Block Patterns.
Block Styles.
Global Styles.
Typography.
Colors.
Responsive layout.
Visual components.

Theme không được trở thành nơi chứa business logic quan trọng.

Ví dụ không nên đặt business logic lớn trong:

functions.php

chỉ vì file này dễ sử dụng.

Nếu chức năng cần tồn tại ngay cả khi thay Theme thì chức năng đó nên thuộc Plugin.

# Plugin

Plugin chịu trách nhiệm về functionality và business logic.

Ví dụ:

Custom Post Type.
Taxonomy.
Custom fields.
Business rules.
Forms.
REST API.
Data processing.
External integrations.
Admin functionality.
Scheduled jobs.
Import / Export.
Notification.
Security functionality.
Reusable functional components.

Một chức năng có giá trị độc lập với giao diện phải ưu tiên đặt trong Plugin.

# Separation of Concerns

Không trộn lẫn:

Presentation
Business Logic
Data Logic
Infrastructure
Configuration

Ví dụ:

Không đưa business rule vào HTML/template chỉ vì việc đó tiện.

Không đưa CSS/UI logic vào Plugin nếu nó chỉ phục vụ presentation của Theme.

Không đưa production configuration vào source code.

# AI Workflow

AI phải ưu tiên workflow:

Requirement
     ↓
Inspect
     ↓
Analyze
     ↓
Explain
     ↓
Human Approval
     ↓
Implement
     ↓
Validate
     ↓
Review Diff
     ↓
Commit
     ↓
Push / Pull Request

Không được bỏ qua bước Inspect đối với task có ảnh hưởng đến repository.

# Inspect Before Modify

Trước khi sửa code, AI phải kiểm tra:

Cấu trúc repository.
File liên quan.
Code hiện tại.
Configuration.
Dependencies.
Git status.
Git diff nếu có thay đổi chưa commit.
Các thành phần liên quan.

Không được giả định rằng functionality chưa tồn tại chỉ vì user không nhắc đến nó.

Không tạo lại code nếu repository đã có implementation tương đương.

# Minimal Change Principle

Ưu tiên:

Smallest correct change.

Không được tự ý:

Rewrite toàn bộ project.
Refactor lớn.
Đổi tên hàng loạt.
Di chuyển file hàng loạt.
Đổi framework.
Thay dependency lớn.
Xóa code đang hoạt động.

nếu task không yêu cầu.

Nếu cần refactor lớn, phải giải thích lý do trước.

# Code Quality

Code phải ưu tiên:

Correctness.
Security.
Readability.
Maintainability.
Simplicity.
Reusability.
Testability.
Predictability.

Không tạo abstraction chỉ để code trông "Enterprise".

Không over-engineering.

Code phải dễ hiểu đối với developer khác.

# Reusability

QNG WebFactory phải ưu tiên tái sử dụng.

Có thể tái sử dụng:

Header.
Footer.
Navigation.
Hero.
CTA.
Card.
Form.
Block Pattern.
Template Part.
Plugin module.
Security helper.
Import / Export.
Notification.
Common utilities.

Không copy/paste cùng một functionality vào nhiều website nếu functionality đó thuộc factory.

Tuy nhiên không được ép mọi functionality thành reusable component khi chưa có nhu cầu thực tế.

# Factory Code và Website-specific Code

Phải phân biệt rõ:

QNG WebFactory

và:

Website-specific

Factory code:

reusable.
generic.
có thể dùng cho nhiều website.

Website-specific code:

Branding.
Content.
Business rule riêng.
Integration riêng.
Configuration riêng.

Không đưa code chỉ dùng cho một website vào factory core nếu chưa có lý do.

# Configuration và Secrets

Không commit:

Password.
API Key.
Token.
Private Key.
Database password.
Production credentials.
OAuth secret.
SMTP credentials.

Sử dụng environment variables.

Ví dụ:

.env
.env.local
.env.production
.env.example

.env.example chỉ chứa placeholder.

Không được đưa secret thật vào .env.example.

# Security

Security là yêu cầu bắt buộc.

AI phải kiểm tra khi phù hợp:

Input validation.
Sanitization.
Output escaping.
Authentication.
Authorization.
Capability checks.
Nonces.
CSRF.
XSS.
SQL Injection.
File upload.
Path traversal.
Sensitive data exposure.

WordPress:

Dùng WordPress APIs khi phù hợp.
Dùng $wpdb->prepare() cho dynamic SQL.
Escape output đúng context.
Validate input.
Sanitize input phù hợp.
Kiểm tra capability trước thao tác privileged.
Sử dụng nonce cho state-changing requests khi cần.

Không tắt security control chỉ để làm development dễ hơn.

# WordPress Coding Rules

Ưu tiên WordPress APIs chính thức.

Sử dụng API phù hợp cho:

Options.
Metadata.
Users.
Roles.
Capabilities.
REST API.
Cron.
Media.
Hooks.
Blocks.

Không truy cập database trực tiếp nếu WordPress API đã cung cấp giải pháp phù hợp.

Hạn chế global state.

Custom functionality phải sử dụng prefix hoặc namespace phù hợp để tránh collision.

# Custom Block Theme / FSE

Theme chuẩn của QNG WebFactory là:

Custom Block Theme / Full Site Editing

Cấu trúc dự kiến:

theme/
├── style.css
├── theme.json
├── functions.php
├── templates/
├── parts/
├── patterns/
├── styles/
└── assets/

Ưu tiên:

theme.json
Templates
Template Parts
Block Patterns
Global Styles
WordPress Blocks

Không duplicate markup nếu có thể sử dụng reusable pattern hoặc template part.

Responsive phải được kiểm tra:

Desktop
Tablet
Mobile

# Accessibility

Accessibility phải được xem xét ngay từ đầu.

Ưu tiên:

Semantic HTML.
Heading hierarchy.
Form labels.
Keyboard navigation.
Focus state.
Alt text.
Color contrast.
Accessible navigation.
Accessible forms.

Không xem accessibility chỉ là công việc cleanup cuối cùng.

# Docker

Docker configuration phải dễ hiểu và reproducible.

Trước khi sửa Docker phải hiểu:

Services.
Images.
Versions.
Ports.
Volumes.
Networks.
Environment variables.
Dependencies.
Persistence.

Không tự ý chạy các lệnh destructive:

docker compose down -v
docker system prune
docker volume prune
docker volume rm

nếu có khả năng mất dữ liệu.

Phải có human approval trước thao tác destructive.

Không xóa database volume chỉ để giải quyết một lỗi ứng dụng nếu chưa xác định rõ hậu quả.

# Version Control

Git là source of truth của project.

Trước khi thay đổi:

git status

Sau khi thay đổi:

git status
git diff

Không được ghi đè thay đổi chưa commit của user.

Không được tự ý force push.

Không được rewrite Git history nếu chưa được phép.

Branch chính:

main
feature/*
fix/*
chore/*

main phải đại diện cho trạng thái ổn định.

# Commit Rules

Commit phải có ý nghĩa.

Ví dụ:

feat: add QNG base theme
fix: correct mobile navigation
refactor: simplify header pattern
chore: update Docker configuration
docs: update development guide
test: add theme validation

Không sử dụng commit message vô nghĩa:

update
test
abc
final
final2

Trước khi commit:

Kiểm tra git status.
Kiểm tra git diff.
Kiểm tra secret.
Kiểm tra file ngoài ý muốn.
Chạy validation phù hợp.
Chỉ commit những thay đổi thuộc task.
# Testing

AI phải thực hiện validation phù hợp với task.

PHP:

php -l path/to/file.php

WordPress:

Activate Theme/Plugin.
Mở trang liên quan.
Test functionality.
Kiểm tra PHP errors.

Browser:

Desktop.
Tablet.
Mobile.
Navigation.
Form.
Interaction.
Console.

Docker:

Container start.
WordPress kết nối database.
Volume hoạt động.
Application hoạt động.

REST API:

HTTP status.
Authentication.
Authorization.
Validation.
Response.
Error handling.

Không được nói:

Tests passed

nếu chưa thực sự chạy test.

Nếu không thể test phải nói rõ:

Validation chưa được thực hiện vì ...
# AI Developer Agent

AI Developer Agent có trách nhiệm:

Đọc requirement.
Inspect repository.
Phân tích.
Đề xuất implementation.
Viết code.
Test.
Review diff.
Báo cáo.

AI Developer Agent không được tự quyết định:

Major architecture.
Production security policy.
Data migration.
Destructive operation.
Major technology replacement.
Production deployment policy.
# AI QA Agent

AI QA Agent có nhiệm vụ kiểm tra độc lập khi phù hợp.

Kiểm tra:

Requirement.
Functional correctness.
Regression.
Security.
UI.
Accessibility.
Error handling.
Code quality.
Git diff.
Unnecessary changes.

Phân loại:

BUG
WARNING
IMPROVEMENT
ARCHITECTURE SUGGESTION

QA không tự sửa code nếu task chỉ yêu cầu review.

# AI Deployment Agent

AI Deployment Agent có thể:

Build.
Validate.
Package.
Deploy approved artifact.
Report deployment result.

Không tự ý:

Delete production data.
Restart production service.
Change production architecture.
Change production security.
Rotate credentials.
Rollback production.

Các thao tác production quan trọng phải có human approval.

# Human Approval

Phải yêu cầu human approval trước:

Major architecture change.
Technology change.
Database change.
Authentication change.
Authorization change.
Security policy change.
Production configuration.
Deployment strategy.
Data migration.
Destructive operation.
Significant deletion.
Major refactor.
Breaking API change.
Dependency replacement lớn.
# Requirement không rõ ràng

Nếu requirement chưa rõ:

Xác định điểm chưa rõ.
Nêu assumption.
Nếu ảnh hưởng behavior hoặc architecture thì hỏi human.
Không tự ý tạo business rule.

Ví dụ:

Requirement:
"Thêm form đăng ký."

Cần xác định:
- Ai được đăng ký?
- Field nào bắt buộc?
- Có email verification không?
- Role mặc định là gì?
- Có cho phép duplicate email không?

Không tự phát minh business rule quan trọng.

# Không xử lý ngoài phạm vi

Nếu phát hiện vấn đề không liên quan task:

Báo cáo.
Nêu impact.
Không tự sửa.
Không trộn vào task hiện tại.

Ví dụ:

Phát hiện một deprecated API ở module khác.

Không thuộc phạm vi task hiện tại nên chưa thay đổi.
# Không Over-engineering

Tuân thủ thứ tự:

Simple
   ↓
Correct
   ↓
Reusable
   ↓
Testable
   ↓
Extendable

Không làm ngược lại.

Không tạo:

Framework nội bộ không cần thiết.
Abstraction quá mức.
Design pattern chỉ để "trông Enterprise".
Dependency không cần thiết.
Configuration quá phức tạp.
Nhiều abstraction layer không có giá trị.
# File Creation Rules

AI chỉ được tạo file khi file đó thực sự cần thiết cho task.

Không tự tạo:

README không cần thiết.
Documentation không yêu cầu.
Helper file không cần thiết.
Test file không cần thiết.
Configuration file không cần thiết.
Framework abstraction không cần thiết.

Trước khi tạo file mới phải kiểm tra xem functionality tương tự đã tồn tại chưa.

# File Deletion Rules

Không tự ý xóa file.

Trước khi xóa phải:

Kiểm tra file được sử dụng ở đâu.
Kiểm tra dependency.
Kiểm tra Git diff.
Xác định impact.
Human approval nếu deletion có rủi ro.

Không xóa file chỉ vì nó "có vẻ không cần".

# Dependency Rules

Không thêm dependency chỉ để giải quyết một vấn đề nhỏ nếu có thể dùng:

WordPress API.
PHP native.
Existing project utility.
Existing dependency.

Trước khi thêm dependency lớn phải đánh giá:

Mục đích.
Kích thước.
Security.
Maintenance.
License.
Compatibility.
Long-term impact.
# Browser Validation

Task liên quan UI phải được kiểm tra trên browser khi có thể.

Kiểm tra:

Desktop
Tablet
Mobile

Kiểm tra:

Layout.
Typography.
Navigation.
Button.
Link.
Form.
Hover.
Focus.
Responsive.
Browser console.

Không kết luận UI đúng chỉ dựa trên source code.

# Change Report

Sau mỗi task quan trọng, AI phải báo cáo:

## Changed

- file/path
- file/path

## Why

- lý do thay đổi

## Validation

- kiểm tra đã thực hiện
- kết quả

## Remaining Issues

- vấn đề còn lại

Nếu không có:

## Remaining Issues

None known.

Không được nói "không còn vấn đề" nếu chưa kiểm tra đầy đủ.

# Khi phát hiện lỗi kiến trúc

Nếu phát hiện architectural issue:

Không tự ý refactor toàn bộ.
Mô tả vấn đề.
Mô tả impact.
Đề xuất solution.
Chờ human approval nếu solution ảnh hưởng architecture.

AI phải phân biệt:

Bug

với:

Architectural Improvement

Không biến mọi improvement thành một phần của task hiện tại.

# Quy trình phát triển QNG WebFactory

Roadmap:

1. AGENTS.md
2. Repository Foundation
3. Docker Foundation
4. Custom Block Theme Foundation
5. Plugin Foundation
6. Development Conventions
7. AI Developer Workflow
8. AI QA Workflow
9. Git / GitHub Workflow
10. Testing
11. Reusable Theme Components
12. Reusable Block Patterns
13. Reusable Plugin Components
14. Deployment Workflow
15. First Real Website

Mỗi stage phải được kiểm tra trước khi chuyển sang stage tiếp theo.

# Nguyên tắc xây dựng Factory

QNG WebFactory phải hướng đến:

Requirement
    ↓
Reusable Component
    ↓
Reusable Theme / Plugin
    ↓
Website-specific Configuration
    ↓
Website

Không nên:

Website 1
Website 2
Website 3
Website 4

với cùng một functionality nhưng copy/paste code độc lập.

# Nguyên tắc ưu tiên

Khi có nhiều phương án, ưu tiên:

Correctness
    ↓
Security
    ↓
Maintainability
    ↓
Simplicity
    ↓
Reusability
    ↓
Performance
    ↓
Convenience

Không hy sinh correctness hoặc security chỉ để phát triển nhanh hơn.

# Nguyên tắc cuối cùng

Mọi thay đổi trong QNG WebFactory phải hướng tới:

Fast Development
        +
Reusable Architecture
        +
Controlled AI
        +
Clean Code
        +
Security
        +
Testing
        +
Git History
        +
Repeatable Deployment
        =
Maintainable WordPress Factory

AI có nhiệm vụ làm cho developer nhanh hơn.

AI không được làm developer mất quyền kiểm soát.

Con người là người quyết định cuối cùng đối với kiến trúc, bảo mật, dữ liệu, production và các thao tác destructive.

# 41. Risk Level và Approval

Phân loại thay đổi theo mức độ rủi ro.

## LOW

Ví dụ:

- Sửa text.
- Sửa CSS nhỏ.
- Sửa typo.
- Sửa documentation.
- Thêm/chỉnh Block Pattern đơn giản.
- Sửa lỗi nhỏ không ảnh hưởng kiến trúc.

AI có thể thực hiện trực tiếp khi requirement rõ.

---

## MEDIUM

Ví dụ:

- Thay đổi nhiều file.
- Thêm plugin/module.
- Thay đổi cấu trúc Theme.
- Thay đổi Docker configuration.
- Thêm dependency.
- Thay đổi API.
- Thay đổi database schema không destructive.
- Refactor module.

AI phải phân tích impact và báo cáo kế hoạch trước khi thực hiện.

Nếu user đã yêu cầu rõ thay đổi đó thì được xem là approval, trừ trường hợp thuộc HIGH RISK.

---

## HIGH

Ví dụ:

- Production deployment.
- Database migration có nguy cơ mất dữ liệu.
- Xóa dữ liệu.
- Xóa volume.
- Thay đổi authentication/authorization quan trọng.
- Thay đổi security policy.
- Thay đổi production credentials.
- Force push.
- Rewrite Git history.
- Thay đổi production infrastructure.
- Rollback production.
- Destructive Docker operation.

AI phải yêu cầu human approval rõ ràng trước khi thực hiện.

Ngay cả khi task có mô tả chung, không được tự suy diễn thành approval cho thao tác destructive.

---

# 42. Commit, Push và Pull Request

AI không tự động:

- Commit.
- Push.
- Merge.
- Tạo Pull Request.

trừ khi user yêu cầu hoặc workflow đã được user phê duyệt rõ ràng.

Trước khi commit phải kiểm tra:

```bash
git status
git diff
```

# Production Stack 

Linux + Nginx/Apache + GitHub Actions hiện là mục tiêu dự kiến của QNG WebFactory.

Đây chưa phải quyết định production architecture cuối cùng.

Không được tự suy diễn:

Linux + Nginx

hoặc:

Linux + Apache

là production architecture bắt buộc.

Khi bắt đầu thiết kế production, phải có một decision riêng.

# Custom Block Theme Scope

Giai đoạn đầu của QNG WebFactory tập trung vào:

WordPress FSE.
Core Blocks.
Block Patterns.
Template Parts.
Templates.
theme.json.
Global Styles.

Không xây Custom Block riêng nếu Core Block + Pattern + Template Part có thể đáp ứng requirement.

Custom Block chỉ được thêm khi requirement thực sự cần behavior hoặc UI mà Core Blocks không đáp ứng phù hợp.

# Quality Gates

Không phải task nào cũng cần chạy toàn bộ test.

Documentation

Kiểm tra:

Markdown syntax.
Nội dung.
Git diff.
Theme

Tối thiểu khi có code liên quan:

PHP syntax.
Theme activation nếu có thể.
Browser validation.
Responsive validation.
Console errors.
Plugin

Tối thiểu khi có code liên quan:

PHP syntax.
Plugin activation.
Chức năng bị ảnh hưởng.
Security checks phù hợp.
Docker

Khi thay đổi Docker:

Compose configuration.
Container startup.
Service connectivity.
Persistence nếu liên quan.
UI

Khi thay đổi giao diện:

Desktop.
Mobile.
Navigation.
Interaction.
Browser console.
Security

Khi thay đổi authentication, authorization, input handling hoặc API:

Security validation bắt buộc.

AI chỉ chạy các quality gate liên quan đến phạm vi thay đổi.

# Secret Incident

Nếu AI phát hiện secret đã được commit hoặc xuất hiện trong Git history:

Dừng task liên quan.
Không tiếp tục push.
Báo rõ loại secret bị lộ.
Đề nghị revoke/rotate credential.
Đánh giá Git history.
Chờ human quyết định phương án xử lý history.

Không coi việc xóa secret khỏi working tree là đã giải quyết xong sự cố.

# Database và Data Safety

Mọi thay đổi database phải xác định:

Schema impact.
Data impact.
Rollback strategy.
Backup requirement.
Compatibility.

Các thao tác:

DROP
TRUNCATE
DELETE lớn
ALTER destructive
Database reset
Volume deletion

được xem là HIGH RISK.

Không thực hiện nếu chưa có approval rõ ràng.

# Ưu tiên khi các nguyên tắc xung đột

Khi hai nguyên tắc có vẻ xung đột, ưu tiên theo thứ tự:

1. Human Safety / Data Safety
2. Security
3. Correctness
4. Existing User Requirements
5. Architecture
6. Maintainability
7. Reusability
8. Performance
9. Convenience

Không hy sinh data safety hoặc security để hoàn thành task nhanh hơn.

# 49. Quan hệ giữa Workflow và Approval

Workflow tổng quát của QNG WebFactory mô tả trình tự công việc:

Requirement
→ Inspect
→ Analyze
→ Plan
→ Implement
→ Validate
→ Review
→ Git

Các bước Git cuối workflow không có nghĩa AI được tự động:

- Commit.
- Push.
- Merge.
- Create Pull Request.

Quy tắc tại mục "Commit, Push và Pull Request" là quy tắc kiểm soát cuối cùng đối với các thao tác Git.

Nếu workflow chung và rule cụ thể có vẻ mâu thuẫn, rule cụ thể về approval và safety được ưu tiên.

---

# 50. Quy tắc phân loại Risk

Risk được xác định dựa trên:

1. Mức độ ảnh hưởng.
2. Phạm vi thay đổi.
3. Khả năng rollback.
4. Môi trường bị ảnh hưởng.
5. Khả năng gây mất dữ liệu hoặc gián đoạn hệ thống.
6. Mức độ ảnh hưởng đến security hoặc access control.

Không phân loại chỉ dựa trên số lượng file thay đổi.

Nếu một thay đổi đồng thời thuộc nhiều mức Risk, sử dụng mức cao nhất.

Nếu chưa đủ thông tin để xác định Risk:

- Không tự giả định là LOW.
- Thu thập thêm thông tin nếu có thể.
- Nếu vẫn không xác định được, xử lý theo mức thận trọng cao hơn.

---

# 51. Approval Policy

## LOW

Nếu requirement rõ ràng và không có dấu hiệu ảnh hưởng MEDIUM/HIGH:

- AI có thể thực hiện trực tiếp.
- Sau đó phải validate và báo cáo kết quả.

## MEDIUM

AI phải:

1. Inspect.
2. Phân tích impact.
3. Nêu kế hoạch thay đổi.
4. Thực hiện khi requirement đã đủ rõ.

Nếu user đã yêu cầu cụ thể một thay đổi MEDIUM thì yêu cầu đó được xem là approval cho phạm vi thay đổi đó.

Nếu requirement chưa đủ rõ để xác định phạm vi hoặc có khả năng chuyển thành HIGH:

- AI phải hỏi lại trước khi thực hiện phần có rủi ro.

MEDIUM không mặc định yêu cầu một vòng approval riêng nếu user đã yêu cầu rõ.

## HIGH

AI phải dừng trước thao tác HIGH RISK.

Một yêu cầu cụ thể của user có thể được xem là approval nếu nó mô tả rõ:

- Thao tác cần thực hiện.
- Đối tượng/phạm vi bị ảnh hưởng.
- Môi trường liên quan nếu có.

Ví dụ:

"Xóa Docker volume qng-wordpress-db ở local để tạo lại database."

là approval cụ thể cho thao tác đó.

Trong khi:

"Reset môi trường Docker."

không đủ cụ thể nếu việc reset có thể dẫn đến mất dữ liệu.

Nếu chưa đủ thông tin:

- Không thực hiện destructive operation.
- Giải thích rủi ro.
- Hỏi user xác nhận phạm vi cần thiết.

---

# 52. Approval không mở rộng ngoài phạm vi

Approval chỉ áp dụng cho phạm vi mà user đã yêu cầu hoặc phê duyệt.

Ví dụ:

User cho phép sửa Docker Compose không có nghĩa AI được phép:

- Xóa volume.
- Reset database.
- Thay đổi production infrastructure.
- Push code.
- Thay đổi credentials.

User cho phép migration database không có nghĩa AI được phép thực hiện:

- DROP.
- TRUNCATE.
- DELETE dữ liệu ngoài phạm vi migration.
- Reset database.

Nếu phát sinh thao tác HIGH RISK mới ngoài phạm vi approval, phải dừng và yêu cầu approval mới.

---

# 53. Quality Gate: Pass / Fail / Blocked

Mỗi task có code hoặc infrastructure phải báo trạng thái validation.

## PASS

Tất cả validation phù hợp với phạm vi task đã hoàn thành và không phát hiện lỗi blocking.

## FAIL

Validation đã chạy và phát hiện lỗi.

AI không được coi task là hoàn thành nếu lỗi ảnh hưởng trực tiếp đến requirement hoặc có khả năng gây regression nghiêm trọng.

## BLOCKED

Validation không thể chạy do thiếu:

- Environment.
- Dependency.
- Credential.
- Service.
- Browser/runtime.
- Database.
- Test data.
- Tool.

Không được giả định BLOCKED là PASS.

Phải báo rõ:

- Validation nào chưa chạy.
- Vì sao chưa chạy.
- Ảnh hưởng của việc chưa validation.
- Cách tiếp tục validation nếu cần.

---

# 54. Validation tối thiểu

Validation phải phù hợp với loại thay đổi.

## Documentation

- Kiểm tra nội dung.
- Kiểm tra Markdown cơ bản.
- Kiểm tra Git diff.

## Theme

Nếu có PHP:

- PHP syntax check.

Nếu có UI:

- Browser validation.
- Responsive validation.
- Console check.

Nếu thay đổi FSE:

- Kiểm tra template.
- Template Part.
- Pattern.
- theme.json liên quan.

## Plugin

- PHP syntax.
- Plugin activation.
- Chức năng bị ảnh hưởng.
- Security validation phù hợp.

## Docker

- Validate Compose configuration.
- Start/recreate service nếu phù hợp.
- Kiểm tra service connectivity.
- Kiểm tra persistence nếu thay đổi volume/database.

## API / Security

- API behavior liên quan.
- Authentication/authorization.
- Input validation.
- Error handling.
- Không để lộ secret hoặc sensitive information.

AI chỉ chạy những validation phù hợp với phạm vi task.

---

# 55. Commit Gate

Trước khi đề xuất hoặc thực hiện commit, AI phải kiểm tra:

- `git status`
- `git diff`
- Các file thay đổi có đúng phạm vi task.
- Không có secret.
- Không có file temporary/build artifact không cần thiết.
- Quality Gate không ở trạng thái FAIL.

Nếu Quality Gate là BLOCKED:

- Có thể báo cáo task chưa được validation đầy đủ.
- Không được mô tả task là fully validated.

Nếu Quality Gate là FAIL:

- Không commit thay đổi gây lỗi đó trừ khi user yêu cầu commit một trạng thái đang được debug và chấp nhận rõ ràng.

---

# 56. Secret Handling

Secret bao gồm nhưng không giới hạn:

- Password.
- API key.
- Access token.
- Refresh token.
- Private key.
- Database credential.
- Production credential.
- OAuth secret.

Không được đưa secret vào:

- Source code.
- Git history.
- Commit message.
- Log.
- Screenshot.
- Generated report.
- Build artifact.
- AI response.

Nếu phát hiện secret:

- Không in giá trị secret.
- Chỉ mô tả loại secret và vị trí phát hiện.
- Dừng push liên quan.
- Đề nghị revoke/rotate.
- Đánh giá history nếu secret đã từng commit.
- Chờ human quyết định cách xử lý Git history.

---

# 57. Database Migration Safety

Đối với database migration:

## Local / Development

Có thể thực hiện migration khi requirement rõ và không thuộc HIGH RISK.

## Staging

Phải kiểm tra:

- Schema compatibility.
- Data impact.
- Application compatibility.
- Rollback strategy.

## Production

Trước migration cần xác định:

- Backup/snapshot strategy.
- Recovery strategy.
- Migration order.
- Expected downtime nếu có.
- Rollback hoặc forward-fix strategy.
- Compatibility với application version.

Không coi "đã backup" là đồng nghĩa với "có thể restore thành công".

Nếu recovery capability chưa được xác minh, phải báo rõ limitation.

Các thao tác destructive vẫn thuộc HIGH RISK.

---

# 58. Environment Boundary

AI phải phân biệt:

- Local.
- Development.
- Staging.
- Production.

Không được áp dụng thao tác dành cho local vào production chỉ vì command hoặc configuration tương tự.

Nếu environment chưa được xác định và thao tác có khả năng gây ảnh hưởng dữ liệu, security hoặc availability:

- Dừng.
- Xác định environment trước khi thực hiện.

---

# 59. Nguyên tắc tối giản

AGENTS.md là bộ nguyên tắc điều khiển AI, không phải tài liệu kỹ thuật triển khai đầy đủ.

Không thêm rule mới nếu rule đó:

- Trùng với rule hiện có.
- Chỉ mô tả một implementation detail.
- Có thể đưa vào README hoặc tài liệu kỹ thuật riêng.
- Không giúp AI ra quyết định tốt hơn.
- Làm workflow trở nên khó sử dụng mà không tăng đáng kể safety hoặc correctness.

Khi cần chi tiết hơn về một subsystem, ưu tiên tạo tài liệu riêng và để AGENTS.md quy định cách AI phải đọc và tuân thủ tài liệu đó.