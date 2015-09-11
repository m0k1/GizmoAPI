<?php namespace spec\Pisa\Api\Gizmo\Repositories;

use PhpSpec\ObjectBehavior;
use Pisa\Api\Gizmo\Adapters\HttpClientAdapter as HttpClient;
use Pisa\Api\Gizmo\Models\User;
use spec\Pisa\Api\Gizmo\HttpResponses;
use zachu\zioc\IoC;

class UserRepositorySpec extends ObjectBehavior
{
    protected static $skip    = 2;
    protected static $top     = 1;
    protected static $orderby = 'Number';

    public function Let(HttpClient $client, IoC $ioc)
    {
        $this->beConstructedWith($client, $ioc);
        $this->shouldHaveType('Pisa\Api\Gizmo\Repositories\UserRepository');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Pisa\Api\Gizmo\Repositories\UserRepository');
    }

    public function it_should_get_all_users(HttpClient $client, IoC $ioc, User $user)
    {
        $client->get('Users/Get', [
            '$skip'    => self::$skip,
            '$top'     => self::$top,
            '$orderby' => self::$orderby,
        ])->shouldBeCalled()->willReturn(HttpResponses::content([
            ['Id' => 1],
            ['Id' => 2],
        ]));

        $ioc->make('User')->shouldBeCalled()->willReturn($user);

        $this->all(self::$top, self::$skip, self::$orderby)->shouldBeArray();
        $this->all(self::$top, self::$skip, self::$orderby)->shouldHaveCount(2);
        $this->all(self::$top, self::$skip, self::$orderby)->shouldContain($user);
    }

    public function it_should_return_empty_list_on_get_all_users(HttpClient $client, IoC $ioc)
    {
        $client->get('Users/Get', [
            '$skip'    => self::$skip,
            '$top'     => self::$top,
            '$orderby' => self::$orderby,
        ])->shouldBeCalled()->willReturn(HttpResponses::emptyArray());

        $ioc->make('User')->shouldNotBeCalled();

        $this->all(self::$top, self::$skip, self::$orderby)->shouldBeArray();
        $this->all(self::$top, self::$skip, self::$orderby)->shouldHaveCount(0);
    }

    public function it_should_throw_on_all_if_got_unexpected_response(HttpClient $client, IoC $ioc)
    {
        $client->get('Users/Get', [
            '$skip'    => self::$skip,
            '$top'     => self::$top,
            '$orderby' => self::$orderby,
        ])->shouldBeCalled()->willReturn(HttpResponses::true());

        $ioc->make('User')->shouldNotBeCalled();

        $this->shouldThrow('\Exception')->duringAll(self::$top, self::$skip, self::$orderby);
    }

    public function it_should_find_users_by_parameters(HttpClient $client)
    {

    }

    public function it_should_find_users_by_case_sensitive_parameters(HttpClient $client)
    {

    }

    public function it_should_throw_on_find_users_by_parameters_if_got_unexpected_response(HttpClient $client)
    {

    }

    public function it_should_find_one_user_by_parameters(HttpClient $client)
    {

    }

    public function it_should_find_one_user_by_case_sensitive_parameters(HttpClient $client)
    {

    }

    public function it_should_throw_on_find_one_user_by_parameters_if_got_unexpected_response(HttpClient $client)
    {

    }

    public function it_should_get_user(HttpClient $client)
    {

    }

    public function it_should_throw_on_get_user_if_got_unexpected_response(HttpClient $client)
    {

    }

    public function it_should_throw_on_get_user_if_parameter_is_not_integer(HttpClient $client)
    {

    }

    public function it_should_check_if_user_exists(HttpClient $client)
    {

    }

    public function it_should_throw_on_has_user_if_got_unexpected_response(HttpClient  $client)
    {

    }

    public function it_should_check_if_username_exists(HttpClient $client)
    {

    }

    public function it_should_throw_on_has_username_if_got_unexpected_response(HttpClient  $client)
    {

    }

    public function it_should_check_if_email_exists(HttpClient $client)
    {

    }

    public function it_should_throw_on_has_email_if_got_unexpected_response(HttpClient  $client)
    {

    }

    public function it_should_check_if_loginname_exists(HttpClient $client)
    {

    }

    public function it_should_throw_on_has_loginname_if_got_unexpected_response(HttpClient $client)
    {

    }
}