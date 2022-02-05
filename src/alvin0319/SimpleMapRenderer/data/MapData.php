<?php

/*
 * MIT License
 *
 * Copyright (c) 2020 - 2021 alvin0319
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

declare(strict_types=1);

namespace alvin0319\SimpleMapRenderer\data;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use pocketmine\color\Color;
use pocketmine\math\Vector3;
use function implode;

final class MapData
{

    protected int $id;
    /** @var Color[][] */
    protected array $colors = [];
    protected bool $displayPlayers = false;
    protected Vector3 $center;

    public function __construct(int $id, array $colors, bool $displayPlayers, Vector3 $center)
    {
        $this->id = $id;
        $this->colors = $colors;
        $this->displayPlayers = $displayPlayers;
        $this->center = $center;
    }

    public function getMapId(): int
    {
        return $this->id;
    }

    /**
     * @param Color[][] $colors
     */
    public function setColors(array $colors): void
    {
        $this->colors = $colors;
    }

    /**
     * @return Color[][]
     */
    public function getColors(): array
    {
        return $this->colors;
    }

    public function getDisplayPlayers(): bool
    {
        return $this->displayPlayers;
    }

    public function getCenter(): Vector3
    {
        return $this->center;
    }

    #[Pure] #[ArrayShape(["id" => "int", "displayPlayers" => "bool", "center" => "string"])]
    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "displayPlayers" => $this->displayPlayers,
            "center" => implode(":", [$this->center->getX(), $this->center->getY(), $this->center->getZ()])
        ];
    }
}