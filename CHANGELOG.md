# Changelog

## Unreleased

## 0.3.0 - 2026-04-14

### Added

- **Documentation:** README **OTP over WhatsApp**: hosted `sendOtp` / `verifyOtp`, REST paths, compliance notes, custom-OTP path.
- `composer.json` `support.docs` points to the product SDK page (`https://tabi.africa/sdks`).
- **PHPDoc:** `array{…}` request- and query-parameter shapes on resource methods (`Auth`, `Channels`, `Messages`, `Contacts`, `Conversations`, `Webhooks`, `ApiKeys`, `Campaigns`, `AutomationInstalls`, `QuickReplies`, `Integrations`, `Workspaces`, etc.), aligned with the public API DTOs.

### Changed

- **Packagist / Composer metadata:** removed `support.source` (and GitHub `issues` / README `docs` links) so the package page does not surface the SDK source repository; documentation discovery uses `support.docs` only.
- **Breaking (HTTP alignment):** `Webhooks::startTestCapture()`, `stopTestCapture()`, and `testCaptureStatus()` now require argument arrays containing `channelId` (body or query as per API). `Webhooks::list(?array $query)` supports optional `channelId` filter.
- README examples corrected for contacts (`name` field), campaigns (`content`), automation installs (no `channelId`), quick replies (`title`/`content`), integrations (`provider` + `credentials`), and webhook test capture / delivery log queries.

### Fixed

- Webhook test-capture calls now send the `channelId` payload the API expects (previously called endpoints with an empty body).

## 0.2.1 - 2026-04-13

### Changed

- README expanded to full resource documentation (parity with the JavaScript SDK guide); removed internal maintainer notes from the public package readme.
- `PUBLISHING.md`: generic maintainer sync notes only (no internal path names).

## 0.2.0 - 2026-04-13

### Changed

- Default API base URL in `TabiClient` is now `https://api.tabi.africa/api/v1`.
- `composer.json` homepage/support URLs point to **tabi.africa**.

### Added

- README with resource groups and **API Keys `create($data)`** field documentation.
- `ApiKeys::list(?array $query)` optional `channelId` filter.
- `PUBLISHING.md` with canonical-repo workflow (GitHub → Packagist).
