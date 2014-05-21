zanox-erp-api
=============

Right now only UserService.asmx and ExportService.asmx are implemented.

## Usage

```php
$userService = new UserService('username', 'password');
$userService->login();

// You can reuse the ticket, so you don't have to login for every request. Store it in a DB or sth ...
$someStorage->storeTicket($userService->getTicket());

$exportService = new ExportService($userService);
$filter = new PpsFilter('2014-05-01T00:00:00+02:00', '2014-05-02T23:59:59+02:00');
$result = $exportService->getPps($programId, $filter);
```

### Debugging

If you need to debug your communication with the SOAP server, you can replace the SoapClient object.

```php
$userService = new UserService('username', 'password');
$soapClient = new \SoapClient($wsdlUrl, array('trace' => true));
$userService->setClient($soapClient);

try {
    $userService->login();
} catch (\Exception $e) {
    var_dump($userService->getClient()->__getLastRequest());
}
```