<?php declare(strict_types = 1);

namespace Mangoweb\Tester\HttpMocks;

use Nette;


class SessionSection extends Nette\Http\SessionSection
{

	/** @var array<string,mixed> */
	private $data = [];


	public function __construct(Nette\Http\Session $session, string $name)
	{
		parent::__construct($session, $name);
	}


	public function getIterator(): \Iterator
	{
		return new \ArrayIterator($this->data);
	}

	public function set(string $name, mixed $value, ?string $expire = null): void
	{
		$this->data[$name] = $value;
	}

	public function get(string $name): mixed
	{
			return $this->data[$name] ?? null;
	}


	/**
	 * @param mixed $value
	 */
	public function __set(string $name, $value): void
	{
		$this->data[$name] = $value;
	}

	/**
	 * @return mixed
	 */
	public function &__get(string $name): mixed
	{
		if ($this->warnOnUndefined && !array_key_exists($name, $this->data)) {
			trigger_error("The variable '$name' does not exist in session section", E_USER_NOTICE);
		}

		return $this->data[$name];
	}


	public function __isset(string $name): bool
	{
		return isset($this->data[$name]);
	}


	public function __unset(string $name): void
	{
		unset($this->data[$name]);
	}


	public function setExpiration(?string $expire, string|array|null $variables = NULL): static
	{
		return $this;
	}


	public function removeExpiration($variables = NULL): void
	{
	}


	public function remove($name = null): void
	{
		if (func_num_args()) {
			foreach ((array) $name as $name) {
				unset($this->data[$name]);
			}
		} else {
			$this->data = [];
		}
	}

}
