<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Transforms
{
    /**
     * Get the buffer as a binary string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toBinary(int $offset = 0, int $length = 0): string
    {
        return implode('', $this->toArray($offset, $length));
    }

    /**
     * Get the buffer as a hex string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toHex(int $offset = 0, int $length = 0): string
    {
        return bin2hex($this->toBinary($offset, $length));
    }

    /**
     * Get the buffer as a UTF-8 string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toUTF8(int $offset = 0, int $length = 0): string
    {
        return mb_convert_encoding($this->toBinary($offset, $length), 'UTF-8', 'UTF-8');
    }

    /**
     * Get the buffer as a base64 string.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toBase64(int $offset = 0, int $length = 0): string
    {
        return base64_encode($this->toBinary($offset, $length));
    }

    /**
     * Get the buffer as an array.
     *
     * @param int $offset
     * @param int $length
     *
     * @return array
     */
    public function toArray(int $offset = 0, int $length = 0): array
    {
        return $this->slice($offset, $length);
    }

    /**
     * Get the buffer as a string.
     *
     * @param string $encoding
     * @param int    $offset
     * @param int    $length
     *
     * @return string
     */
    public function toString(string $encoding, int $offset = 0, int $length = 0): string
    {
        switch ($encoding) {
            case 'binary':
                return $this->toBinary($offset, $length);
            case 'hex':
                return $this->toHex($offset, $length);
            case 'base64':
                return $this->toBase64($offset, $length);
            case 'utf8':
                return $this->toUTF8($offset, $length);
            default:
                throw new \Exception("The encoding [{$encoding}] is not supported.");
        }
    }
}
