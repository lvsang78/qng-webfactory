# QNG-WebFactory Capability Map v1.0

## Mục đích và cách đọc

QNG-WebFactory là một **Factory để xây dựng nhiều website WordPress**, không phải một website cụ thể. Tài liệu này mô tả ranh giới năng lực hiện có và hướng phát triển có thể cân nhắc.

- **Current**: có bằng chứng trong repository hoặc là nền tảng phát triển đang được sử dụng. Điều này không đồng nghĩa mọi năng lực đã hoàn thiện, tự động hóa hoặc sẵn sàng production.
- **Future**: hướng phát triển tiềm năng, chưa được xem là đã triển khai hay requirement hiện tại. Chỉ đưa vào phạm vi khi có nhu cầu thực tế và được quyết định phù hợp.

Factory assets cần có khả năng tái sử dụng để Copilot/developer có thể áp dụng vào nhiều dự án. Nội dung, branding, business rules và tích hợp chỉ dành cho một website cần được giữ ở phạm vi website đó, trừ khi có căn cứ rõ ràng để đưa vào Factory.

## 1. Foundation

**Mục đích:** Cung cấp nền móng source control, môi trường phát triển và các thành phần WordPress nền tảng để xây dựng, kiểm tra và tái sử dụng tài sản Factory.

### Current

- Git repository và quy trình làm việc với Git/GitHub.
- Docker Compose cho môi trường WordPress local cùng MariaDB.
- WordPress là CMS/runtime nền tảng.
- QNG Base Theme là nền tảng Block Theme/FSE ban đầu.
- QNG Core Plugin có entry point và Bootstrap foundation. `Bootstrap::boot()` hiện chưa triển khai functionality.

### Future

- Hoàn thiện quy ước và workflow phát triển khi nhu cầu sử dụng thực tế cho thấy còn thiếu.
- Cải thiện khả năng lặp lại và xác minh môi trường local theo nhu cầu của Factory.

## 2. Design System

**Mục đích:** Cung cấp ngôn ngữ thiết kế chung, nhất quán và có thể tái sử dụng. `theme.json` là nguồn chính cho các design token của QNG Base; Pattern nên sử dụng token có sẵn thay vì tự đặt giá trị thiết kế trùng lặp.

### Current

- `theme.json` khai báo nền tảng Design System.
- **Color:** palette gồm màu primary/secondary, màu trạng thái và nhóm neutral.
- **Typography:** font families, font-size presets và cấu hình fluid typography.
- **Spacing:** spacing scale có các preset từ `xs` đến `3xl`.
- **Layout:** `contentSize` và `wideSize` presets.

### Future

- Điều chỉnh hoặc mở rộng token khi có yêu cầu thiết kế thực tế và đánh giá được lợi ích tái sử dụng.
- Kiểm tra token trong những Pattern/layout mới để bảo đảm vai trò và cách dùng nhất quán.

Không thêm token chỉ vì có thể cần trong tương lai; không coi các token tiềm năng là một phần của hệ thống hiện tại.

## 3. UI / Patterns

**Mục đích:** Cung cấp các giao diện khối có thể tái sử dụng, dễ chỉnh sửa trong WordPress Editor và ưu tiên WordPress Core Blocks.

### Current

Các Pattern hiện có trong QNG Base Theme:

- **QNG Hero**
- **QNG Section**
- **QNG CTA**

Các Pattern này là nền tảng UI trung tính, không đại diện cho một website khách hàng cụ thể.

### Future

- Các Pattern bổ sung có thể được xem xét theo nhu cầu lặp lại, chẳng hạn nhóm nội dung, card hoặc các biến thể section.
- Mỗi Pattern mới cần dùng Design System hiện có khi phù hợp và không mang business logic website-specific.

Không xem danh sách ví dụ tương lai là cam kết xây dựng hoặc requirement cho phiên bản hiện tại.

## 4. Templates / Pages

**Mục đích:** Định nghĩa cấu trúc trình bày và template hierarchy dùng chung cho nội dung WordPress, đồng thời giữ khả năng mở rộng theo yêu cầu thực tế.

### Current

QNG Base hiện có các template:

- `index.html`
- `page.html`
- `single.html`
- `archive.html`
- `search.html`
- `404.html`

Các template này tạo bộ nền Block Theme ban đầu. Chúng không có nghĩa là mọi website type hoặc mọi page layout đã được đáp ứng.

### Future

- Mở rộng hoặc bổ sung template khi có requirement thực tế và nhu cầu template hierarchy cụ thể.
- Xem xét các template chuyên biệt cho homepage, posts index hoặc loại nội dung khác khi use case yêu cầu; không tạo thêm template chỉ để tăng số lượng.

## 5. Functionality

**Mục đích:** Đặt functionality và business logic có thể tồn tại độc lập với giao diện trong Plugin, tách biệt với presentation của Theme.

### Current

- QNG Core Plugin hiện chỉ có foundation/Bootstrap.
- Chưa có module functionality được xác nhận là đã triển khai trong QNG Core.

### Future

- Reusable functionality có thể được bổ sung vào QNG Core hoặc plugin phù hợp khi xuất hiện requirement rõ ràng và có lợi ích sử dụng lại.
- Functionality chỉ dành cho một website, gồm business rules và tích hợp riêng, cần được tách khỏi Factory core nếu không có lý do tái sử dụng.

**Chưa được tuyên bố là đã triển khai:** REST API, Security, Authentication, Forms, SEO, Ecommerce hoặc các module nghiệp vụ khác. Việc một loại functionality được nêu ở đây không hàm ý quyết định triển khai hoặc kiến trúc cụ thể.

## 6. Website Types

**Mục đích:** Dùng nền tảng chung để hỗ trợ xây dựng nhiều loại website bằng cách kết hợp Design System, Theme assets và functionality phù hợp; không biến QNG-WebFactory thành một website hay một sản phẩm ngành dọc cụ thể.

### Current

- Factory có nền tảng WordPress, QNG Base Theme, Design System và một số Pattern dùng chung.
- Chưa xác nhận có bộ giải pháp hoàn chỉnh hoặc starter kit chuyên biệt cho từng loại website dưới đây.

### Future

Các nhóm website mục tiêu có thể được hỗ trợ dần theo yêu cầu thực tế:

- Corporate: sản xuất, xây dựng, dịch vụ.
- Ecommerce.
- Landing Page.
- Portfolio.
- Education / School.
- Blog / News.
- Healthcare.
- Hospitality.
- Real Estate.
- Các loại website khác phát sinh trong tương lai.

Đây là các nhóm use case mục tiêu, không phải năng lực đã hoàn thiện. Thành phần dùng chung thuộc Factory; branding, nội dung và business functionality đặc thù thuộc website tương ứng, trừ khi được xác định là reusable một cách có chủ đích.

## 7. AI Knowledge

**Mục đích:** Giúp Copilot/developer hiểu mục tiêu, kiến trúc, conventions và cách làm việc của Factory để tạo giải pháp nhất quán, có thể tái sử dụng và nằm đúng ranh giới Theme/Plugin.

### Current

- `AGENTS.md` quy định mục tiêu repository, nguyên tắc kiến trúc, bảo mật, workflow và cách AI Agent làm việc.
- `README.md` mô tả mục tiêu, cấu trúc kiến trúc và AI/Copilot workflow ở mức tổng quan.
- Architecture conventions xác lập Theme là presentation, Plugin là functionality/business logic, WordPress Core là nền tảng và Docker là infrastructure.
- AI/Copilot workflow đặt yêu cầu inspect, phân tích, validation và review thay đổi trong quy trình phát triển.

### Future

- Cập nhật hướng dẫn khi conventions hoặc các reusable assets thay đổi.
- Bổ sung hướng dẫn sử dụng cụ thể cho các tài sản Factory khi có nhu cầu thực tế.

Không giả định đã có một knowledge base tự động, hệ thống sinh website hoàn chỉnh hoặc quy trình AI chuyên biệt ngoài những tài liệu và workflow hiện có.

## 8. Quality / Deployment

**Mục đích:** Bảo đảm các thay đổi được kiểm tra phù hợp trước khi chia sẻ hoặc triển khai, đồng thời tách rõ môi trường local khỏi production.

### Current

- Git dùng để quản lý mã nguồn và thay đổi.
- Docker hỗ trợ local development với WordPress và MariaDB.
- Responsive testing là một chiều kiểm tra cần xem xét trên desktop, tablet và mobile khi phù hợp.
- Accessibility testing là một chiều kiểm tra cần xem xét, gồm semantic structure, keyboard/focus và khả năng tiếp cận nội dung.
- Những điểm kiểm tra trên mô tả workflow/tiêu chí hiện hành; không hàm ý đã có automated test suite hoặc quality gate tự động cho mọi mục.

### Future

- Hoàn thiện các bước validation và quality gates theo loại thay đổi, nếu được yêu cầu.
- Xây dựng CI/CD và deployment workflow sau khi có quyết định về môi trường, chính sách bảo mật và quy trình production.

Docker local không được mặc định là production architecture. Deployment và CI/CD chưa được mô tả như năng lực đã triển khai trong Capability Map này.

## Nguyên tắc kiến trúc xuyên suốt

- QNG-WebFactory là Factory; không gắn nền tảng với Core Billing hay bất kỳ sản phẩm riêng nào.
- **Theme chịu trách nhiệm presentation**; **Plugin chịu trách nhiệm functionality/business logic**.
- Design System là nền tảng chung; các Pattern nên sử dụng token hiện có khi token đó đáp ứng nhu cầu.
- Reusable assets cần có cấu trúc và conventions dễ hiểu để Copilot/developer có thể tìm và áp dụng.
- Website-specific functionality, branding, nội dung và business rules không được đưa vào Factory chỉ vì có thể tái sử dụng về mặt kỹ thuật.
- Future không phải requirement hiện tại. Chỉ mở rộng khi có use case cụ thể, tránh over-engineering.
