# inventaris

## Deployment / cache notes

- After modifying route definitions, run:
  - `php artisan route:clear`
  - `php artisan config:clear`
  - `php artisan view:clear`
  - `php artisan optimize`

This prevents stale cached routes from causing `Target class [YourController] does not exist` errors.
 
