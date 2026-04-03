# Qoliber Magento Open Source Security

Security hardening package for Magento Open Source and Adobe Commerce.

This package contains two Magento 2 modules:

- `Qoliber_PolyshellPatch`
- `Qoliber_SessionReaperFix`

Both modules are intended as defensive mitigations. They deliberately disable specific upload flows that can be abused.

## What It Fixes

### PolyShell

`Qoliber_PolyshellPatch` blocks file-type custom option uploads through the Web API product option flow.

This is intended as a mitigation for the vulnerability commonly referred to as `PolyShell` and associated with Adobe bulletin `APSB25-94`.

Security tradeoff:

- file-type custom option uploads through this API path are disabled
- integrations relying on that upload behavior will stop working until a vendor patch or a different safe implementation is used

### SessionReaper

`Qoliber_SessionReaperFix` overrides the frontend customer address file upload controller and returns `404 Not Found`.

This closes unauthorized uploads to the customer address media directory.

Important note:

- the original `SessionReaper` issue is already addressed by released Adobe / Magento patches
- however, those patches still allow unauthorized upload attempts to the `customer_address` media directory
- this module hard-disables that upload endpoint as an additional security measure

Security tradeoff:

- customer address file uploads are disabled
- any storefront functionality depending on customer address file attachments will no longer work

## Installation

Install the package with Composer in your Magento project:

```bash
composer require qoliber/magento-open-source-security
```

Then apply Magento setup changes:

```bash
bin/magento setup:upgrade
bin/magento cache:flush
```

## Warnings

- This package is intentionally restrictive.
- It is designed to reduce attack surface, not to preserve all original upload features.
- Review business flows and third-party integrations before enabling it in production.
- If you depend on file uploads in custom options or customer address flows, test those paths explicitly after installation.

## Package Contents

- `src/polyshell-patch-module` provides `Qoliber_PolyshellPatch`
- `src/session-reaper-fix-module` provides `Qoliber_SessionReaperFix`

## License

MIT
