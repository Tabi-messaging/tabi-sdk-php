# Publishing `tabi/sdk` (Packagist)

**Recommended workflow:** treat **[`Tabi-messaging/tabi-sdk-php`](https://github.com/Tabi-messaging/tabi-sdk-php)** as the **only** place you commit PHP SDK changes and tags. Packagist reads that repository; tags (e.g. `v0.2.0`) become installable versions—not a `version` field in `composer.json`.

## Day-to-day development

1. **Clone** (once per machine):

   ```bash
   git clone https://github.com/Tabi-messaging/tabi-sdk-php.git
   cd tabi-sdk-php
   ```

2. **Branch, implement, document** — README, CHANGELOG, inline docblocks, optional `docs/` folder. Keep [`composer.json`](./composer.json) metadata accurate (`homepage`, `support`).

3. **Open a PR** to `main` (or your default branch), merge when ready.

## Cutting a release

1. On the latest `main`, update [`CHANGELOG.md`](./CHANGELOG.md) (move items out of *Unreleased* into the new version section).

2. **Sanity check:**

   ```bash
   find src -name '*.php' -print0 | xargs -0 -n1 php -l
   ```

3. **Tag and push** (semver `vMAJOR.MINOR.PATCH`):

   ```bash
   git pull origin main
   git tag v0.2.0
   git push origin main
   git push origin v0.2.0
   ```

4. On [Packagist](https://packagist.org/packages/tabi/sdk), use **Update** if the webhook did not fire; the new version usually appears within a few minutes.

## If you edited the copy inside the WaAPI monorepo

That folder is **not** what Packagist watches. To publish those changes:

1. Clone or `cd` into `tabi-sdk-php` as above.
2. Copy files from the monorepo path into the clone (preserve structure), e.g.:

   ```bash
   rsync -a --delete /path/to/PSIRS-INFRA/projects/waapi/packages/tabi-sdk-php/ ./ --exclude .git
   ```

3. Review `git diff`, commit, push to `main`, then **tag and push the tag** as in *Cutting a release*.

## Before tagging

- [`CHANGELOG.md`](./CHANGELOG.md) and [`README.md`](./README.md) match what users should see on GitHub/Packagist.
- No secrets or env-specific URLs committed.
