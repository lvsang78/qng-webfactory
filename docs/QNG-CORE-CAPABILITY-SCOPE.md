# QNG Core Capability Scope v1.0

## 1. Mục đích và quyết định phạm vi

QNG-WebFactory là Factory để tạo nhanh nhiều loại website WordPress từ yêu cầu mô tả tự nhiên. QNG Core chỉ nên chứa functionality trung lập về nghiệp vụ, có ranh giới rõ và có bằng chứng cần tái sử dụng giữa các website. Việc một capability xuất hiện trên nhiều loại website không tự động có nghĩa capability đó phải thuộc QNG Core.

### Quy ước trạng thái

- **Current**: có bằng chứng trong source/runtime đã kiểm tra.
- **Proposed / REQUIRED FOR QNG CORE v1.0**: phạm vi được đề xuất cho v1.0; không đồng nghĩa đã triển khai.
- **CANDIDATE FOR FUTURE**: có thể cân nhắc sau khi có use case lặp lại, yêu cầu rõ và quyết định kiến trúc.
- **OUT OF SCOPE**: không thuộc QNG Core v1.0. Một số mục có thể do WordPress Core, plugin chuyên biệt hoặc website instance xử lý.

Tài liệu này đề xuất phạm vi, không phê duyệt implementation. Không tạo module, Admin UI, API, security subsystem hay abstraction để “chuẩn bị”.

## 2. Kiến trúc và ranh giới trách nhiệm

```text
WordPress Core
    ├── QNG Base Theme
    │      ├── Design System (theme.json)
    │      ├── Templates / Template Parts
    │      └── Presentation Patterns
    ├── QNG Core Plugin
    │      └── Chỉ chứa reusable behavior được chấp thuận
    ├── Plugin chuyên biệt khi cần
    └── Website Instance
           ├── Content / branding / configuration cụ thể
           └── Business rules / integrations riêng
```

Sơ đồ biểu diễn **quyền sở hữu**, không phải chuỗi dependency bắt buộc. QNG Core không được phụ thuộc vào QNG Base Theme để functionality tiếp tục tồn tại khi đổi theme. Pattern/Template trình bày giao diện; chúng không thay thế backend behavior hoặc business rules.

| Lớp | Trách nhiệm |
|---|---|
| WordPress Core | CMS, block editor, bài viết/trang, taxonomy, media library, navigation/search cơ bản, users/roles/capabilities, authentication và API nền tảng. |
| QNG Base Theme | Presentation, Design System, layout, templates, template parts, responsive styling và patterns. |
| QNG Core Plugin | Reusable behavior trung lập về nghiệp vụ chỉ khi có nhu cầu cross-site đã được xác nhận. |
| Plugin chuyên biệt | Capability có domain sâu hoặc đã có giải pháp trưởng thành như ecommerce, forms/CRM, SEO, multilingual, security hoặc event management. |
| Website Instance | Content, branding, cấu hình và business-specific functionality/integration không có lý do tái sử dụng ở Factory. |

## 3. Repository evidence đã kiểm tra

### Current trong Factory

- QNG Base Block Theme: `factory/themes/qng-base/`.
- Design tokens trong `theme.json`: color palette, font family/size, fluid typography, spacing scale, `contentSize` và `wideSize`.
- Header/Footer Template Parts: `parts/header.html`, `parts/footer.html`.
- Sáu templates: `404.html`, `archive.html`, `index.html`, `page.html`, `search.html`, `single.html`.
- Ba WordPress block patterns: QNG Hero, QNG Section và QNG CTA.
- QNG Core entry point `factory/plugins/qng-core/qng-core.php` nạp `src/Core/Bootstrap.php` rồi gọi `Bootstrap::boot()`.
- `Bootstrap::boot()` hiện rỗng; chưa có functional module QNG Core được xác nhận.
- Docker Compose định nghĩa WordPress và MariaDB cho local development.
- `AGENTS.md`, `readme.md` và Capability Map mô tả nguyên tắc kiến trúc/AI workflow.

### Phân biệt source Factory với plugin/theme có sẵn

Repository cũng có WordPress plugin/theme files ở các thư mục root `plugins/` và `themes/`, bao gồm Akismet, Hello Dolly và WordPress bundled themes. Chúng không phải QNG Core capability hoặc QNG Base source chỉ vì xuất hiện trong repository/runtime. Tài liệu này không gán functionality của plugin bên thứ ba cho QNG Core.

### Chưa được xác nhận là QNG Core capability

Không tìm thấy module riêng cho forms, leads, CPT/content models, custom fields, SEO, analytics, email delivery, ecommerce, payments, multilingual, caching hoặc AI runtime trong QNG Core.

## 4. Cách quyết định capability thuộc lớp nào

Đối với mỗi yêu cầu website mới:

1. Kiểm tra WordPress Core đã đáp ứng nhu cầu cơ bản chưa.
2. Nếu chỉ là presentation/content arrangement, dùng QNG Base templates, template parts, theme.json và Core Blocks/patterns.
3. Nếu là domain chuyên biệt, đánh giá plugin chuyên dụng đã được duy trì thay vì đưa feature vào QNG Core.
4. Nếu chỉ phục vụ một website, đặt ở Website Instance.
5. Chỉ xem xét QNG Core khi behavior trung lập về nghiệp vụ, không gắn với Theme, cần trên nhiều website độc lập, chưa được Core/plugin chuyên dụng đáp ứng tốt, và có owner/test/security/data contract rõ.
6. Không tạo module chỉ dựa trên danh sách loại website mục tiêu hoặc dự đoán rằng “có thể cần”.

## 5. Capability mapping theo nhu cầu website

| Nhu cầu / ví dụ | WordPress Core | QNG Base / Pattern | QNG Core v1.0 | Plugin chuyên biệt | Website Instance |
|---|---|---|---|---|---|
| Trang, bài viết, nội dung corporate/news | Posts, Pages, categories/tags, Editor | Templates, layout và patterns trình bày | Không cần | Không cần mặc định | Nội dung, thương hiệu và cấu trúc thông tin cụ thể |
| Contact information, CTA, social links | Site Identity, navigation, links và content blocks | Header/Footer, Hero/CTA/Section có thể trình bày nội dung | Không cần | Chỉ khi có behavior chuyên biệt | Địa chỉ, số điện thoại, URL và nội dung cụ thể |
| Testimonials, team, doctors, projects/portfolio | Pages/Posts và metadata APIs đủ cho nhu cầu đơn giản; không cung cấp sẵn một domain model hoàn chỉnh cho từng mục | Pattern/layout để trình bày dữ liệu | Chưa cần; tránh áp đặt content model chung | Plugin phù hợp nếu cần model/archive/query chuyên biệt dùng lại | Dữ liệu và model riêng nếu chỉ có một site |
| Contact form, lead capture, admission form, appointment request | Không có form submission/lead workflow tổng quát tích hợp sẵn trong Core | Có thể cung cấp vị trí/layout cho form, không xử lý submission | Không đưa form engine/lead CRM vào v1.0 | Forms plugin; CRM/integration plugin khi cần | Trường, consent, retention, routing và quy trình theo nghiệp vụ |
| Events cho School/Hospitality | Posts/pages và taxonomy tổng quát | Presentation cho event content | Không có event domain module trong v1.0 | Event/calendar plugin nếu cần lịch, recurrence, booking | Quy tắc đăng ký/lịch riêng nếu site-specific |
| Ecommerce product, cart, checkout, payment | Không có ecommerce commerce workflow đầy đủ trong Core | Có thể trình bày trang, nhưng không xử lý thương mại | Không thuộc v1.0 | WooCommerce hoặc nền tảng ecommerce/plugin chuyên biệt và payment gateway | Catalog, pricing, shipping/tax/policy theo cửa hàng |
| Analytics, SEO, marketing attribution | Không có giải pháp SEO/analytics toàn diện trong Core; có API nền tảng liên quan | Semantic markup và presentation đúng vai trò | Không đưa tracking/SEO suite vào v1.0 | SEO/analytics/integration plugin hoặc provider phù hợp | Consent, tracking IDs và business measurement requirements |
| Media và upload | Media Library, attachment, image processing và capability checks | Hiển thị media qua blocks/templates | Không cần media manager riêng | Plugin nếu cần workflow xử lý chuyên biệt | Quy định media, file types hoặc workflow đặc thù |
| Search | Search query và Search block cho nội dung WordPress cơ bản | Search template/block presentation | Không cần search engine riêng | Search plugin/service cho indexing, faceting hoặc scale đặc thù | Cấu hình/scope tìm kiếm riêng |
| Login, users, roles, capabilities | Users, roles/capabilities và authentication cơ bản | Giao diện không thay thế access control | Không cần auth/user management riêng trong v1.0 | Membership/SSO plugin khi cần chức năng nâng cao | Quy tắc tài khoản/role đặc thù |
| REST API và AJAX | REST API, hooks và AJAX mechanisms sẵn có trong Core | Không phải trách nhiệm presentation | Không cần một API layer tổng quát chỉ để chuẩn bị | Plugin riêng khi API phục vụ domain cụ thể | Endpoint/integration chỉ dùng cho site đó |
| Email/notifications | `wp_mail()` là API gửi mail cơ bản; không bảo đảm cấu hình SMTP/deliverability hoặc workflow notifications tổng quát | Có thể trình bày trạng thái/thông báo UI | Không xây SMTP/notification subsystem trong v1.0 | SMTP/delivery, forms hoặc notification plugin phù hợp | Nội dung email, recipient và policy theo nghiệp vụ |
| Security | WordPress cung cấp API và controls nền tảng; plugin/theme vẫn phải code an toàn | Theme phải escape/render đúng và không nắm business authorization | Security là yêu cầu xuyên suốt mọi code, không phải lý do tạo security suite trong QNG Core v1.0 | Security/hardening plugin hoặc dịch vụ phù hợp khi cần | Policy và threat requirements riêng |
| Custom Post Types / taxonomy / custom fields | APIs cho registration và metadata tồn tại; Core không tự quyết định content model của Factory/site | Có thể trình bày loại nội dung nếu đã đăng ký | Không đăng ký model chung trong v1.0 khi chưa có schema cross-site được duyệt | Content-model plugin nếu một model tái sử dụng có phạm vi rõ | CPT/fields dành riêng cho site |

## 6. Phân loại capability kỹ thuật được yêu cầu xem xét

| Capability | Trạng thái đề xuất đối với QNG Core v1.0 | Owner ưu tiên / lý do |
|---|---|---|
| Forms | OUT OF SCOPE | Không có form engine tổng quát trong WordPress Core; xử lý dữ liệu/consent/spam/email cần chọn forms plugin, không nhân bản trong QNG Core. |
| Contact / Lead Management | OUT OF SCOPE | CRM, retention, routing và access policy phụ thuộc nghiệp vụ; forms/CRM plugin hoặc Website Instance. |
| Custom Post Types | OUT OF SCOPE hiện tại; CANDIDATE FOR FUTURE nếu model chung được xác nhận | WordPress có API registration; model cụ thể nên ở site/plugin domain. Tránh một QNG Core bắt buộc content model cho mọi site. |
| Custom Fields | OUT OF SCOPE hiện tại; CANDIDATE FOR FUTURE theo schema tái sử dụng đã duyệt | WordPress có metadata APIs; field editing/schema thường cần plugin hoặc domain model cụ thể. |
| Media/File handling | OUT OF SCOPE cho module mới | Media Library xử lý nhu cầu thông thường. Upload workflow nâng cao cần plugin/site-specific, kiểm tra quyền và security. |
| SEO | OUT OF SCOPE | Dùng plugin SEO trưởng thành; Theme đảm nhiệm semantic presentation cơ bản, không làm SEO admin suite. |
| Analytics | OUT OF SCOPE | Provider, consent và mục tiêu đo lường khác nhau; plugin/provider hoặc Website Instance. |
| SMTP/Email | OUT OF SCOPE | WordPress mail API không phải mail delivery platform; cấu hình qua provider/plugin chuyên dụng. |
| Notifications | OUT OF SCOPE | Nội dung, kênh, recipient và retry rules phụ thuộc use case; plugin/site-specific. |
| Search | OUT OF SCOPE để mở rộng Core search cơ bản | WordPress Core đã có search; nâng cao thì plugin/service chuyên dụng. |
| REST API | OUT OF SCOPE như capability riêng của QNG Core | REST API là WordPress Core; endpoint chỉ được thêm cùng requirement domain đã duyệt. |
| AJAX | OUT OF SCOPE như framework riêng | WordPress có AJAX/REST mechanisms; dùng cơ chế phù hợp cho feature cụ thể, không bọc thêm abstraction. |
| Security | OUT OF SCOPE như module/security suite; secure coding là bắt buộc | Dùng WordPress APIs, validation, sanitization, escaping, capabilities/nonces theo feature; hardening chuyên biệt dùng plugin/provider. |
| Authentication | OUT OF SCOPE | Core có authentication cơ bản; SSO/membership/identity nâng cao dùng plugin chuyên biệt. |
| User management | OUT OF SCOPE | Core có users/roles/capabilities; workflow membership/portal dùng plugin/site logic. |
| Settings | OUT OF SCOPE trong v1.0 | Chưa có QNG Core behavior cần cấu hình; không tạo settings framework trước khi có feature yêu cầu. |
| Admin UI | OUT OF SCOPE trong v1.0 | Không tạo dashboard/admin shell chỉ để trống; dùng WP Admin hoặc plugin cụ thể khi cần. |
| Shortcodes | OUT OF SCOPE | Ưu tiên Core Blocks/patterns; không thêm shortcode layer không có requirement. |
| Custom Blocks | OUT OF SCOPE hiện tại | Dùng Core Blocks, patterns và templates; chỉ đánh giá block riêng khi Core không đáp ứng behavior/UI bắt buộc. |
| Integrations | OUT OF SCOPE trong QNG Core chung | Tích hợp provider/domain riêng; dùng integration plugin hoặc code ở Website Instance. |
| Ecommerce | OUT OF SCOPE | Dùng WooCommerce hoặc giải pháp commerce chuyên dụng; không giả định mọi Factory site bán hàng. |
| Payments | OUT OF SCOPE | PCI/payment provider scope, checkout và commerce domain thuộc plugin chuyên biệt. |
| Multilingual | OUT OF SCOPE | Dùng plugin multilingual đã chọn cho site; không tạo translation framework trong QNG Core. |
| Performance | OUT OF SCOPE như plugin tối ưu tổng hợp | Đo bottleneck trước; caching và hosting phụ thuộc môi trường, dùng Core APIs/provider/plugin phù hợp. |
| Caching | OUT OF SCOPE | Object cache API có trong Core; cache backend, page cache và invalidation phụ thuộc hạ tầng/plugin. |

## 7. AI / Copilot: capability thuộc Factory, không mặc định thuộc Plugin

AI-ready workflow là năng lực của **Factory architecture và documentation**, không phải một yêu cầu phải nhúng AI logic vào QNG Core.

Các nguồn hướng dẫn hiện có là `AGENTS.md`, `readme.md` và Capability Map. Copilot/developer cần dùng chúng để:

1. Đọc customer requirement và làm rõ câu hỏi ảnh hưởng behavior/architecture.
2. Xác định website type/use case nhưng không tự suy ra mọi feature ngành dọc.
3. Kiểm tra repository và chọn Pattern/Template hiện có khi phù hợp.
4. Kiểm tra WordPress Core, QNG Base và plugin phù hợp trước khi viết functionality.
5. Tách content/config/business-specific behavior vào Website Instance khi không tái sử dụng.
6. Chỉ đề xuất QNG Core change khi chứng minh được behavior neutral/cross-site; yêu cầu kiến trúc quan trọng cần người phê duyệt.
7. Tránh trùng code bằng cách tìm source/implementation trước khi thêm module.
8. Ghi rõ Current/Future, chạy validation phù hợp và báo cáo thay đổi; không tự commit/push.

**Không thuộc QNG Core v1.0:** LLM client, prompt engine, website generator, autonomous agent, customer requirement parser, AI API credentials, vector database hoặc AI admin UI. Nếu Factory sau này cần các năng lực này, chúng cần architecture decision riêng và có thể thuộc tooling bên ngoài WordPress.

## 8. QNG Core v1.0 Proposed Scope

### Quyết định đề xuất

QNG Core v1.0 nên là **plugin foundation mỏng, ổn định và không áp đặt nghiệp vụ**. Với bằng chứng và assets hiện tại, chưa có functional capability dùng chung nào đủ cơ sở để bắt buộc đưa vào QNG Core. Vì vậy, v1.0 không nên thêm feature module mới cho tới khi một requirement cụ thể chứng minh nhu cầu tái sử dụng.

| Name | Scope classification | Purpose | Why it belongs to QNG Core | Reusability | Dependencies | Complexity | Current status | Implementation priority |
|---|---|---|---|---|---|---|---|---|
| Minimal plugin lifecycle / Bootstrap | **REQUIRED FOR QNG CORE v1.0** — giữ foundation hiện có; không mở rộng nếu chưa có feature được duyệt. | Là entry point nhỏ để WordPress nạp QNG Core và gọi một điểm khởi động duy nhất; chỉ đăng ký behavior đã được duyệt khi có requirement. | Là ranh giới kỹ thuật tối thiểu của chính QNG Core plugin, không chứa presentation hay domain logic. Không phải lý do để thêm framework/module rỗng. | Tái sử dụng làm điểm nạp cho các feature cross-site được chấp thuận; không mang behavior website cụ thể. | WordPress plugin loading; PHP; source hiện có `qng-core.php` và `src/Core/Bootstrap.php`. | Thấp nếu giữ nguyên tối thiểu; tăng đáng kể nếu thêm autoloader/container không cần thiết. | **Đã có foundation**: entry point require Bootstrap và gọi `boot()`. `boot()` rỗng; chưa có functional module. Runtime activation không được suy ra chỉ từ source trong scope review này. | **P0 – giữ tối thiểu và xác minh** PHP syntax/plugin load khi có môi trường kiểm thử. Không mở rộng Bootstrap trước feature đã được duyệt. |
| Cross-site website behavior modules | **CANDIDATE FOR FUTURE** — chưa thuộc implementation scope v1.0. | Cung cấp functionality trung lập về nghiệp vụ được chứng minh cần thiết ở nhiều Website Instances. | Chỉ thuộc QNG Core khi không được WordPress Core đáp ứng, không thuộc presentation, không phù hợp hơn với plugin chuyên biệt và có hợp đồng dữ liệu/security/test rõ. | Cao nếu có use case lặp lại độc lập; hiện chưa xác định module cụ thể. | WordPress APIs và yêu cầu feature cụ thể; dependency chỉ được chọn sau quyết định về module. | Chưa thể ước lượng trước khi có feature; không triển khai ở v1.0 theo bằng chứng hiện tại. | **Chưa tồn tại / chưa được xác nhận.** | **Không có implementation priority trong v1.0.** Đưa ra decision riêng khi có use case cross-site thực tế. |

Capability thứ hai là **điều kiện tiếp nhận trong tương lai**, không phải module hay lời mời tạo một lớp abstraction trống trong QNG Core v1.0.

## 9. Future Candidates

Chưa triển khai. Mỗi mục cần requirement thực tế và decision riêng trước khi thay đổi source:

- Một reusable content model/CPT nếu cùng schema và behavior thực sự được dùng ở nhiều website.
- Behavior dùng chung có data lifecycle rõ ràng mà WordPress Core và plugin chuyên biệt không đáp ứng phù hợp.
- Một integration adapter chỉ khi nhiều Website Instances cần cùng contract/provider behavior và việc dùng plugin chuyên dụng không phù hợp.
- Các API/admin controls liên quan feature cụ thể sau khi đã xác định nhu cầu, quyền truy cập, dữ liệu, UX và kiểm thử.
- Documentation/catalogue cho AI để chọn Factory assets nếu quy mô và nhu cầu sử dụng cho thấy cần thêm ngoài `AGENTS.md`, `readme.md` và Capability Map.

Future không phải backlog đã được cam kết, không phải requirement của v1.0 và không phải lý do dựng sẵn REST, security, settings, admin, service container hoặc module rỗng.

## 10. Explicitly Out of Scope

| Không thuộc QNG Core v1.0 | Lý do / owner phù hợp |
|---|---|
| Business rules, branding, content, contact details, team/project/doctor records của một khách hàng | Website Instance; không thuộc Factory core nếu không có use case tái sử dụng. |
| Forms, lead/CRM management, admission, appointment workflows | Forms/CRM plugin hoặc Website Instance; có yêu cầu privacy, consent, retention, spam và notification theo nghiệp vụ. |
| Ecommerce catalog, cart, checkout, tax/shipping và payments | WooCommerce/nền tảng commerce và extension/provider tương ứng. |
| Event calendar/booking | Plugin chuyên biệt hoặc Website Instance theo mô hình nghiệp vụ. |
| Generic CPT/custom-fields framework | WordPress APIs hoặc plugin chuyên biệt; schema chưa được xác nhận dùng chung. |
| SEO, analytics, SMTP/email delivery và generic notifications | Plugin/provider phù hợp; phụ thuộc policy, consent, delivery và use case. |
| Security suite/authentication/membership/SSO/user portal | Core cung cấp nền tảng auth/access controls; yêu cầu nâng cao dùng plugin chuyên biệt. Secure coding vẫn bắt buộc cho mọi QNG Core code. |
| REST/AJAX framework chung, settings framework, Admin dashboard, service container, dependency injection, autoloader | Không có requirement hiện tại; tạo abstraction trước use case sẽ tăng độ phức tạp. |
| Shortcodes/custom blocks khi Core Blocks, patterns, templates đáp ứng được | Theme và WordPress Core; chỉ xem xét custom block theo requirement behavior/UI chưa được đáp ứng. |
| Multilingual, caching/performance suite, search service | Plugin chuyên biệt/provider/hạ tầng theo nhu cầu; không thuộc plugin chung cho mọi website. |
| AI runtime hoặc autonomous website generation trong WordPress | AI Knowledge là Factory documentation/workflow; tooling AI và credentials không mặc định nằm trong QNG Core. |
| Functionality chỉ phục vụ một website hoặc một sản phẩm | Website Instance hoặc plugin sản phẩm độc lập; không đưa business logic sản phẩm riêng vào Factory Core. |

## 11. Implementation Order sau khi scope được phê duyệt

Các phase dưới đây là thứ tự ra quyết định/triển khai tương lai, không phải yêu cầu tạo module ngay bây giờ.

### Phase 1 — Xác minh foundation hiện có

- Giữ QNG Core entry point và Bootstrap mỏng.
- Khi môi trường có PHP, xác minh syntax và plugin loading/activation.
- Không thêm autoloader, container, settings, admin page, API hoặc feature module chỉ để chuẩn bị.

### Phase 2 — Chứng minh capability dùng chung

- Lấy requirement cụ thể từ website instance.
- Tìm giải pháp WordPress Core/plugin chuyên biệt trước.
- So sánh use cases để xác định behavior có thực sự lặp lại, neutral và độc lập với Theme không.
- Nếu phù hợp, đề xuất module, data/security contract, dependencies, tests và migration/lifecycle impacts; chờ phê duyệt scope.

### Phase 3 — Implement và validate một capability đã duyệt

- Chỉ implement capability đã được xác nhận trong decision riêng.
- Giữ module nhỏ, dùng WordPress APIs, tôn trọng privacy/security và không buộc các website khác phải bật capability.
- Kiểm tra PHP syntax, activation, feature behavior, permissions/input/output và regression phù hợp với feature.
- Chỉ cập nhật tài liệu capability sau khi implementation tồn tại và đã được kiểm tra.

Nếu không có use case cross-site đã chứng minh, dừng ở Phase 1. Không cần tạo Phase 2/3 modules để QNG Core được coi là đúng phạm vi.

## 12. Kết luận

- **QNG Core v1.0:** plugin foundation/Bootstrap tối thiểu; không thêm functionality dùng chung mới theo bằng chứng hiện tại.
- **WordPress Core:** đảm nhiệm CMS primitives và APIs phổ biến trước khi cân nhắc plugin.
- **QNG Base Theme / Patterns:** đảm nhiệm presentation và bố cục tái sử dụng.
- **Plugin chuyên biệt:** đảm nhiệm domain sâu, provider integration hoặc workflow đã có giải pháp phù hợp.
- **Website Instance:** đảm nhiệm content, branding, business rules và functionality riêng.
- **AI-ready:** conventions và knowledge thuộc Factory docs/workflow; không đòi QNG Core chứa AI logic.
- Capability Future chỉ được đưa vào implementation sau requirement cụ thể và decision phù hợp; không tự động trở thành scope hiện tại.
