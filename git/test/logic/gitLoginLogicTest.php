<?php
require_once('autoload.php');
class gitLoginLogicTest extends PHPUnit_Framework_TestCase {
  private $mockAction;
  private $mockAccountService;
  private $mockDasherDomainChecker;
  private $logic;
  private $response;

  protected function setUp() {
    $this->mockAction = $this->getMock('gitLoginAction');
    $this->mockAccountService = $this->getMock('gitAccountService');
    $this->mockDasherDomainChecker = $this->getMock('gitDasherDomainChecker');
    gitContext::setAccountService($this->mockAccountService);
    gitContext::setDasherDomainChecker($this->mockDasherDomainChecker);
    $this->logic = new gitLoginLogic($this->mockAction);
    $this->response = new gitLoginResponse();
  }

  protected function tearDown() {
    gitContext::setAccountService(NULL);
    gitContext::setDasherDomainChecker(NULL);
  }

  public function testErrorEmailFormat() {
    $request = new gitLoginRequest('invalidEmail', '');
    $this->mockAction->expects($this->once())
        ->method('sendErrorEmailFormat');
    $this->logic->run($request, $this->response);
  }

  public function testErrorEmptyEmail() {
    $request = new gitLoginRequest('', '');
    $this->mockAction->expects($this->once())
        ->method('sendErrorEmptyEmail');
    $this->logic->run($request, $this->response);
  }

  public function testExistFederatedPassword() {
    $email = 'a@gmail.com';
    $account = new gitAccount($email,gitAccount::FEDERATED);
    $request = new gitLoginRequest($email, '12345');
    // Email exists.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue($account));

    $this->mockAction->expects($this->once())
        ->method('sendErrorFederatedWithPassword');

    $this->logic->run($request, $this->response);
  }

  public function testExistFederatedNoPassword() {
    $email = 'a@gmail.com';
    $account = new gitAccount($email, gitAccount::FEDERATED);
    $request = new gitLoginRequest($email, '');
    // Email exists.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue($account));

    $this->mockAction->expects($this->once())
        ->method('sendNeedFederated');

    $this->logic->run($request, $this->response);
  }

  public function testExistLegacyPasswordCorrect() {
    $email = 'a@test.com';
    $password = '12345';
    $account = new gitAccount($email, gitAccount::LEGACY);
    $request = new gitLoginRequest($email, $password);
    // Email exists.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue($account));
    // Password is correct.
    $this->mockAccountService->expects($this->once())
        ->method('checkPassword')
        ->with($email, $password)
        ->will($this->returnValue(true));
    // 'test.com' is not a federated domain.
    $this->mockDasherDomainChecker->expects($this->once())
        ->method('isDasherDomain')
        ->will($this->returnValue(false));

    $this->mockAction->expects($this->once())
        ->method('setLegacyTab');
    $this->mockAction->expects($this->once())
        ->method('sendOk');
    $this->mockAction->expects($this->once())
        ->method('login');

    $this->logic->run($request, $this->response);
    $this->assertFalse($request->getDomainFederated());
  }

  public function testExistLegacyPasswordWrong() {
    $email = 'a@test.com';
    $password = '12345';
    $account = new gitAccount($email, gitAccount::LEGACY);
    $request = new gitLoginRequest($email, $password);
    // Email exists.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue($account));
    // Password is wrong.
    $this->mockAccountService->expects($this->once())
        ->method('checkPassword')
        ->with($email, $password)
        ->will($this->returnValue(false));
    // 'test.com' is not a federated domain.
    $this->mockDasherDomainChecker->expects($this->once())
        ->method('isDasherDomain')
        ->will($this->returnValue(false));

    $this->mockAction->expects($this->once())
        ->method('sendErrorPassword');

    $this->logic->run($request, $this->response);
    $this->assertFalse($request->getDomainFederated());
  }

  public function testExistLegacyNoPasswordUpgrade() {
    $email = 'a@test.com';
    $password = '';
    $account = new gitAccount($email, gitAccount::LEGACY);
    $request = new gitLoginRequest($email, $password);
    // Email exists.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue($account));
    // 'test.com' is not a federated domain.
    $this->mockDasherDomainChecker->expects($this->once())
        ->method('isDasherDomain')
        ->with('test.com')
        ->will($this->returnValue(true));

    $this->mockAction->expects($this->once())
        ->method('sendNeedFederated');

    $this->logic->run($request, $this->response);
    $this->assertTrue($request->getDomainFederated());
  }

  public function testExistLegacyNoPasswordNoUpgrade() {
    $email = 'a@test.com';
    $password = '';
    $account = new gitAccount($email, gitAccount::LEGACY);
    $request = new gitLoginRequest($email, $password);
    // Email exists.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue($account));
    // 'test.com' is not a federated domain.
    $this->mockDasherDomainChecker->expects($this->once())
        ->method('isDasherDomain')
        ->with('test.com')
        ->will($this->returnValue(false));

    $this->mockAction->expects($this->once())
        ->method('sendErrorPassword');

    $this->logic->run($request, $this->response);
    $this->assertFalse($request->getDomainFederated());
  }

  public function testNoExistFederatedPassword() {
    $email = 'a@gmail.com';
    $password = '12345';
    $request = new gitLoginRequest($email, $password);
    // Email doesn't exist.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue(NULL));

    $this->mockAction->expects($this->once())
        ->method('sendErrorFederatedWithPassword');

    $this->logic->run($request, $this->response);
    $this->assertTrue($request->getDomainFederated());
  }

  public function testNoExistFederatedNoPassword() {
    $email = 'a@gmail.com';
    $password = '';
    $request = new gitLoginRequest($email, $password);
    // Email doesn't exist.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue(NULL));

    $this->mockAction->expects($this->once())
        ->method('sendNeedFederated');

    $this->logic->run($request, $this->response);
    $this->assertTrue($request->getDomainFederated());
  }

  public function testNoExistLegacyPassword() {
    $email = 'a@test.com';
    $password = '12345';
    $request = new gitLoginRequest($email, $password);
    // Email doesn't exist.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue(NULL));
    // 'test.com' doesn't support federated login.
    $this->mockDasherDomainChecker->expects($this->once())
        ->method('isDasherDomain')
        ->with('test.com')
        ->will($this->returnValue(false));

    $this->mockAction->expects($this->once())
        ->method('sendErrorUnregistered');

    $this->logic->run($request, $this->response);
    $this->assertFalse($request->getDomainFederated());
  }

  public function testNoExistLegacyNoPassword() {
    $email = 'a@test.com';
    $password = '';
    $request = new gitLoginRequest($email, $password);
    // Email doesn't exist.
    $this->mockAccountService->expects($this->once())
        ->method('getAccountByEmail')
        ->with($email)
        ->will($this->returnValue(NULL));
    // 'test.com' doesn't support federated login.
    $this->mockDasherDomainChecker->expects($this->once())
        ->method('isDasherDomain')
        ->with('test.com')
        ->will($this->returnValue(false));

    $this->mockAction->expects($this->once())
        ->method('sendErrorUnregistered');

    $this->logic->run($request, $this->response);
    $this->assertFalse($request->getDomainFederated());
  }
}

