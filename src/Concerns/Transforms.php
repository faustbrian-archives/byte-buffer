<?php

namespace BrianFaust\ByteBuffer\Concerns;

trait Transforms
{
    /**
     * Get the buffer as a plain array.
     *
     * @param int $start
     * @param int $end
     *
     * @return array
     */
    public function toArray(int $start = 0, int $end = 0): array
    {
        return $this->buffer->toArray();
    }

    /**
     * Get the buffer as a plain base64 string.
     *
     * @param int $start
     * @param int $end
     *
     * @return array
     */
    public function toBase64(int $start = 0, int $end = 0): string
    {
        return base64_encode($this->toBinary());
    }

    /**
     * Get the buffer as a plain binary string.
     *
     * @param int $start
     * @param int $end
     *
     * @return array
     */
    public function toBinary(int $start = 0, int $end = 0): string
    {
        return implode('', $this->toArray());
    }

    /**
     * Get the buffer as a plain hex string.
     *
     * @param int $start
     * @param int $end
     *
     * @return array
     */
    public function toHex(int $start = 0, int $end = 0): string
    {
        return bin2hex($this->toBinary());
    }

    /**
     * Get the buffer as a plain UTF-8 string.
     *
     * @param int $start
     * @param int $end
     *
     * @return array
     */
    public function toUTF8(int $start = 0, int $end = 0): string
    {
        return mb_convert_encoding($this->toBinary(), 'UTF-8', 'UTF-16');
    }

    /**
     * Get the buffer as a plain string.
     *
     * @param int $start
     * @param int $end
     *
     * @return string
     */
    public function toString(string $encoding, int $start = 0, int $end = 0): string
    {
        switch ($encoding) {
            case 'utf8':
                return $this->toUTF8($start, $end);
            case 'base64':
                return $this->toBase64($start, $end);
            case 'hex':
                return $this->toHex($start, $end);
            case 'binary':
                return $this->toBinary($start, $end);
            default:
                throw new \Exception("The encoding [{$encoding}] is not supported.");
        }
    }
}
