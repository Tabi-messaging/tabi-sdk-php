# Publishing `tabi/sdk` (Packagist)

**Recommended workflow:** treat **[`Tabi-messaging/tabi-sdk-php`](https://github.com/Tabi-messaging/tabi-sdk-php)** as the **only** place you commit PHP SDK changes and tags. Packagist reads that repository; tags (e.g. `v0.2.0`) become installable versions—not a `version` field in `composer.json`.

## Day-to-day development

1. **Clone** (once per machine):

   ```bash
   git clone https://github.com/Tabi-messaging/tabi-sdk-php.git
   cd tabi-sdk-php
   ```

2. **Branch, implement, document** — README, CHANGELOG, inline docblocks, optional `docs/` folder. Keep [`composer.json`](./composer.json) metadata accurate: `homepage` and **`support.docs`** should point at the public product page (`https://tabi.africa/sdks`), not a VCS URL. Do not add `support.source` if Packagist should not show a source-repository link.

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

## If you edited a duplicate checkout elsewhere

If you maintain the same tree in another directory, copy those files into **this** repository (the one Packagist tracks), then commit, push, and tag as in *Cutting a release*. Use `rsync` or your usual merge process; exclude `.git` so you do not overwrite this repo’s history.

## Before tagging

- [`CHANGELOG.md`](./CHANGELOG.md) and [`README.md`](./README.md) match what users should see on Packagist and in `vendor/tabi/sdk/README.md`.
- No secrets or env-specific URLs committed.
