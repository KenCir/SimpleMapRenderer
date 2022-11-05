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

namespace alvin0319\SimpleMapRenderer;

use alvin0319\SimpleMapRenderer\data\MapData;
use alvin0319\SimpleMapRenderer\item\FilledMap;
use pocketmine\color\Color;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\ClientboundMapItemDataPacket;
use pocketmine\network\mcpe\protocol\MapInfoRequestPacket;
use pocketmine\network\mcpe\protocol\types\BlockPosition;
use pocketmine\network\mcpe\protocol\types\MapDecoration;
use pocketmine\network\mcpe\protocol\types\MapImage;
use pocketmine\network\mcpe\protocol\types\MapTrackedObject;
use pocketmine\player\Player;
use pocketmine\Server;
use function count;

class EventListener implements Listener
{

    public function onDataPacketReceived(DataPacketReceiveEvent $event): void
    {
        $packet = $event->getPacket();
        $player = $event->getOrigin()->getPlayer();
        if ($packet instanceof MapInfoRequestPacket) {
            $mapId = $packet->mapId;
            if (($mapData = MapFactory::getInstance()->getMapData($mapId)) !== null) {
                $event->cancel();
                $this->sendMapInfo($player, $mapId, $mapData, Server::getInstance()->getOnlinePlayers());
            }
        }
    }

    public function sendMapInfo(Player $player, int $mapId, MapData $mapData, array $includePlayers = []): void
    {
        $pk = new ClientboundMapItemDataPacket();
        $pk->mapId = $mapId;
        $pk->colors = new MapImage($mapData->getColors());
        $pk->origin = new BlockPosition(0, 0, 0);
        if (count($includePlayers) > 0) {
            if ($mapData->getDisplayPlayers()) {
                /**
                 * @var Player $playerId
                 */
                foreach ($includePlayers as $player) {
                    /** @var Player $target */
                    $target = $player;
                    $pk->decorations[] = $this->getMapDecoration($mapData, $target);
                    $pk->trackedEntities[] = $this->getMapTrackedObject($mapData, $target);
                }
            }
        }
        $pk->scale = 1;
        $player->getNetworkSession()->sendDataPacket($pk);
    }

    public function onPlayerMove(PlayerMoveEvent $event): void
    {
        $item = $event->getPlayer()->getInventory()->getItemInHand();
        if (!$item instanceof FilledMap) return;
        if (($mapData = MapFactory::getInstance()->getMapData($item->getMapId())) !== null) {
            $this->sendMapInfo($event->getPlayer(), $item->getMapId(), $mapData, Server::getInstance()->getOnlinePlayers());
        }
    }

    public function onPlayerItemHeld(PlayerItemHeldEvent $event): void
    {
        $item = $event->getItem();
        $player = $event->getPlayer();
        if ($item instanceof FilledMap) {
            $mapData = MapFactory::getInstance()->getMapData($item->getMapId());
            if ($mapData instanceof MapData) {
                $this->sendMapInfo($player, $mapData->getMapId(), $mapData, Server::getInstance()->getOnlinePlayers());
            }
        }
    }

    private function getMapDecoration(MapData $data, Player $player): MapDecoration
    {
        $rotation = $player->getLocation()->getYaw();

        $i = 1 << 0;
        $f = ($player->getPosition()->getFloorX() - $data->getCenter()->getX()) / $i;
        $f1 = ($player->getPosition()->getFloorZ() - $data->getCenter()->getZ()) / $i;
        $b0 = (int)(($f * 2.0) + 0.5);
        $b1 = (int)(($f1 * 2.0) + 0.5);
        $j = 63;

        $rotation = $rotation + ($rotation < 0.0 ? -8.0 : 8.0);
        $b2 = ((int)($rotation * 16.0 / 360.0));

        if ($f <= -$j) {
            $b0 = (int)(($j * 2) + 2.5);
        }

        if ($f1 <= -$j) {
            $b1 = (int)(($j * 2) + 2.5);
        }

        if ($f >= $j) {
            $b0 = (int)($j * 2 + 1);
        }
        if ($f1 >= $j) {
            $b1 = (int)($j * 2 + 1);
        }

        return new MapDecoration(0, $b2, $b0, $b1, $player->getName(), $color ?? new Color(255, 255, 255));
    }

    private function getMapTrackedObject(MapData $data, Player $player): MapTrackedObject
    {
        $tracking = new MapTrackedObject();
        $tracking->type = MapTrackedObject::TYPE_ENTITY;
        $tracking->actorUniqueId = $player->getId();
        return $tracking;
    }
}