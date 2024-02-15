# Hyperf-impersonate component

Includes the following classes:

- Contract:
  - Impersonatable;
- Controller:
  - ImpersonateController;
- DTO:
  - ImpersonateInfoDTO;
  - ImpersonateLeaveDTO;
  - ImpersonateTakeDTO;
- Event:
  - LeaveImpersonation
  - TakeImpersonation
- Exception:
  - AlreadyImpersonatingException;
  - CantBeImpersonatedException;
  - CantImpersonateException;
  - CantImpersonateSelfException;
  - NotImpersonatingException;
  - ProtectedAgainstImpersonationException;
- Middleware:
  - ProtectFromImpersonation;
- Resource:
  - ResourceInfoImpersonate;
  - ResourceLeaveImpersonate;
  - ResourceTakeImpersonate;
- Service:
  - ImpersonateService;
- Trait
  - Impersonatable

Install:

```shell script
composer require onix-systems-php/hyperf-impersonate
```

Publish config and database migrations:

```shell script
php bin/hyperf.php vendor:publish onix-systems-php/hyperf-impersonate
```

Import impersonate routes:

```php
require_once './vendor/onix-systems-php/hyperf-auth/publish/routes.php';
```

Add line to ```config/autoload/swagger.php``` for swagger:

```php
'vendor/onix-systems-php/hyperf-impersonate/src/',
```

## Basic Usage

```php
use OnixSystemsPHP\HyperfImpersonate\Contract\Impersonatable as ImpersonatableInterface;
use OnixSystemsPHP\HyperfImpersonate\Trait\Impersonatable;

class User extends ... implements ImpersonatableInterface
{
    use Impersonatable;
}
```

## Advanced Usage

### Defining impersonation authorization

By default all users can impersonate an user.
You need to add the method `canImpersonate()` to your user model:

```php
public function canImpersonate(): bool
{
    return in_array($this->getRole(), UserRoles::GROUP_ADMINS);
}
```

By default all users can be impersonated.
You need to add the method `canBeImpersonated()` to your user model to extend this behavior:

```php
public function canBeImpersonated(): bool
{
    return in_array($this->getRole(), UserRoles::GROUP_USERS);
}
```
