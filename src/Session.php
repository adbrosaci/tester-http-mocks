<?php declare(strict_types = 1);

namespace Mangoweb\Tester\HttpMocks;

use Nette;


class Session extends Nette\Http\Session
{

	/** @var SessionSection[] */
	private $sections = [];

	/** @var bool */
	private $started = FALSE;

	/** @var bool */
	private $exists = FALSE;

	/** @var string */
	private $id;


	public function start(): void
	{
		$this->started = TRUE;
	}


	public function isStarted(): bool
	{
		return $this->started;
	}


	public function close(): void
	{
		$this->started = FALSE;
	}


	public function destroy(): void
	{
		$this->started = FALSE;
	}


	public function exists(): bool
	{
		return $this->exists;
	}


	public function setFakeExists(bool $exists): void
	{
		$this->exists = $exists;
	}


	public function regenerateId(): void
	{
	}


	public function getId(): string
	{
		return $this->id;
	}


	public function setFakeId(string $id): void
	{
		$this->id = $id;
	}


	public function getSection(string $section, string $class = SessionSection::class): Nette\Http\SessionSection
	{
		if (isset($this->sections[$section])) {
			return $this->sections[$section];
		}

		$sessionSection = parent::getSection($section, $class);
		assert($sessionSection instanceof SessionSection);

		return $this->sections[$section] = $sessionSection;
	}


	public function hasSection(string $section): bool
	{
		return isset($this->sections[$section]);
	}


	public function getIterator(): \Iterator
	{
		return new \ArrayIterator(array_keys($this->sections));
	}


	public function clean(): void
	{
	}


	public function setName(string $name): static
	{
		return $this;
	}


	public function getName(): string
	{
		return '';
	}

	/**
	 * @param array<string,mixed> $options
	 */
	public function setOptions(array $options): static
	{
		return $this;
	}

	/**
	 * @return array<string,mixed>
	 */
	public function getOptions(): array
	{
		return [];
	}


	public function setExpiration(?string $time): static
	{
		return $this;
	}


	public function setCookieParameters(string $path, string $domain = NULL, bool $secure = NULL, string $samesite = NULL): static
	{
		return $this;
	}

	/**
	 * @return array<string,mixed>
	 */
	public function getCookieParameters(): array
	{
		return [];
	}

	public function setSavePath(string $path): static
	{
		return $this;
	}


	public function setHandler(\SessionHandlerInterface $handler): static
	{
		return $this;
	}
}
