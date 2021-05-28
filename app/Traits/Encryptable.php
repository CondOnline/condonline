<?php


namespace App\Traits;


trait Encryptable
{
    /**
     * Decrypt the column value if it is in the encrypted array.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);
        if (in_array($key, $this->encrypted ?? [])) {
            $value = $this->decryptValue($value);
        }

        return $value;
    }

    /**
     * Decrypts a value only if it is not null and not empty.
     *
     * @param $value
     *
     * @return mixed
     */
    protected function decryptValue($value)
    {
        if ($value !== null && !empty($value)) {
            return decryption($value);
        }

        return $value;
    }

    /**
     * Set the value, encrypting it if it is in the encrypted array.
     *
     * @param $key
     * @param $value
     *
     * @return
     */
    public function setAttribute($key, $value)
    {
        if ($value !== null && in_array($key, $this->encrypted ?? [])) {
            $value = encryption($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Retrieves all values and decrypts them if needed.
     *
     * @return mixed
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        foreach ($this->encrypted ?? [] as $key) {
            if (isset($attributes[$key])) {
                $attributes[$key] = $this->decryptValue($attributes[$key]);
            }
        }

        return $attributes;
    }
}
