<?php
declare(strict_types=1);

namespace App\Core\Services;

/**
 * Class TokenGenerator
 *
 * @package App\Core\Services
 */
class TokenGenerator
{
    /** @var int  */
    private $entropy;

    /**
     * Generates URI-safe tokens.
     */
    public function __construct()
    {
        $this->entropy = 512;
    }

    /**
     * @param int|null $entropy
     *
     * @return string
     * @throws \Exception
     */
    public function generate(int $entropy = null): string
    {
        $bytes = random_bytes((int)(($entropy ?: $this->entropy) / 8));

        return rtrim(strtr(base64_encode($bytes), '+/', '-_'), '=');
    }
}
