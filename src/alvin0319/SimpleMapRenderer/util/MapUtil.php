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

namespace alvin0319\SimpleMapRenderer\util;

use pocketmine\block\Block;
use pocketmine\block\BlockLegacyIds as Ids;
use pocketmine\block\BlockLegacyMetadata as Meta;
use pocketmine\block\utils\TreeType;
use pocketmine\color\Color;

final class MapUtil
{

    public const COLOR_BLOCK_WHITE = 0;
    public const COLOR_BLOCK_ORANGE = 1;
    public const COLOR_BLOCK_MAGENTA = 2;
    public const COLOR_BLOCK_LIGHT_BLUE = 3;
    public const COLOR_BLOCK_YELLOW = 4;
    public const COLOR_BLOCK_LIME = 5;
    public const COLOR_BLOCK_PINK = 6;
    public const COLOR_BLOCK_GRAY = 7;
    public const COLOR_BLOCK_LIGHT_GRAY = 8;
    public const COLOR_BLOCK_CYAN = 9;
    public const COLOR_BLOCK_PURPLE = 10;
    public const COLOR_BLOCK_BLUE = 11;
    public const COLOR_BLOCK_BROWN = 12;
    public const COLOR_BLOCK_GREEN = 13;
    public const COLOR_BLOCK_RED = 14;
    public const COLOR_BLOCK_BLACK = 15;

    /**
     * Credits from Altay
     *
     * @param Block $block
     *
     * @return Color
     * @link https://github.com/TuranicTeam/Altay/blob/stable/src/pocketmine/maps/renderer/VanillaMapRenderer.php#L172#L274
     */
    public static function getMapColorByBlock(Block $block): Color
    {
        $meta = $block->getMeta();
        $id = $block->getId();
        if ($id === Ids::AIR) {
            return new Color(0, 0, 0);
        } elseif ($id === Ids::GRASS or $id === Ids::SLIME_BLOCK) {
            return new Color(127, 178, 56);
        } elseif ($id === Ids::SAND or $id === Ids::SANDSTONE or $id === Ids::SANDSTONE_STAIRS or ($id === Ids::STONE_SLAB and ($meta & 0x07) == Meta::STONE_SLAB_SANDSTONE) or ($id === Ids::DOUBLE_STONE_SLAB and $meta == Meta::STONE_SLAB_SANDSTONE) or $id === Ids::GLOWSTONE or $id === Ids::END_STONE or ($id === Ids::PLANKS and $meta == TreeType::BIRCH()->getMagicNumber()) or ($id === Ids::LOG and ($meta & 0x03) == TreeType::BIRCH()->getMagicNumber()) or $id === Ids::BIRCH_FENCE_GATE or ($id === Ids::FENCE and $meta = TreeType::BIRCH()->getMagicNumber()) or $id === Ids::BIRCH_STAIRS or ($id === Ids::WOODEN_SLAB and ($meta & 0x07) == TreeType::BIRCH()->getMagicNumber()) or $id === Ids::BONE_BLOCK or $id === Ids::END_BRICKS) {
            return new Color(247, 233, 163);
        } elseif ($id === Ids::BED_BLOCK or $id === Ids::COBWEB) {
            return new Color(199, 199, 199);
        } elseif ($id === Ids::LAVA or $id === Ids::STILL_LAVA or $id === Ids::FLOWING_LAVA or $id === Ids::TNT or $id === Ids::FIRE or $id === Ids::REDSTONE_BLOCK) {
            return new Color(255, 0, 0);
        } elseif ($id === Ids::ICE or $id === Ids::PACKED_ICE or $id === Ids::FROSTED_ICE) {
            return new Color(160, 160, 255);
        } elseif ($id === Ids::IRON_BLOCK or $id === Ids::IRON_DOOR_BLOCK or $id === Ids::IRON_TRAPDOOR or $id === Ids::IRON_BARS or $id === Ids::BREWING_STAND_BLOCK or $id === Ids::ANVIL or $id === Ids::HEAVY_WEIGHTED_PRESSURE_PLATE) {
            return new Color(167, 167, 167);
        } elseif ($id === Ids::SAPLING or $id === Ids::LEAVES or $id === Ids::LEAVES2 or $id === Ids::TALL_GRASS or $id === Ids::DEAD_BUSH or $id === Ids::RED_FLOWER or $id === Ids::DOUBLE_PLANT or $id === Ids::BROWN_MUSHROOM or $id === Ids::RED_MUSHROOM or $id === Ids::WHEAT_BLOCK or $id === Ids::CARROT_BLOCK or $id === Ids::POTATO_BLOCK or $id === Ids::BEETROOT_BLOCK or $id === Ids::CACTUS or $id === Ids::SUGARCANE_BLOCK or $id === Ids::PUMPKIN_STEM or $id === Ids::MELON_STEM or $id === Ids::VINE or $id === Ids::LILY_PAD) {
            return new Color(0, 124, 0);
        } elseif (($id === Ids::WOOL and $meta == self::COLOR_BLOCK_WHITE) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_WHITE) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_WHITE) or $id === Ids::SNOW_LAYER or $id === Ids::SNOW_BLOCK) {
            return new Color(255, 255, 255);
        } elseif ($id === Ids::CLAY_BLOCK or $id === Ids::MONSTER_EGG) {
            return new Color(164, 168, 184);
        } elseif ($id === Ids::DIRT or $id === Ids::FARMLAND or ($id === Ids::STONE and $meta == Meta::STONE_GRANITE) or ($id === Ids::STONE and $meta == Meta::STONE_GRANITE) or ($id === Ids::SAND and $meta == 1) or $id === Ids::RED_SANDSTONE or $id === Ids::RED_SANDSTONE_STAIRS or ($id === Ids::STONE_SLAB2 and ($meta & 0x07) == Meta::STONE_SLAB2_RED_SANDSTONE) or ($id === Ids::LOG and ($meta & 0x03) == TreeType::JUNGLE()->getMagicNumber()) or ($id === Ids::PLANKS and $meta == TreeType::JUNGLE()->getMagicNumber()) or $id === Ids::JUNGLE_FENCE_GATE or ($id === Ids::FENCE and $meta == TreeType::JUNGLE()->getMagicNumber()) or $id === Ids::JUNGLE_STAIRS or ($id === Ids::WOODEN_SLAB and ($meta & 0x07) == TreeType::JUNGLE()->getMagicNumber())) {
            return new Color(151, 109, 77);
        } elseif ($id === Ids::STONE or ($id === Ids::STONE_SLAB and ($meta & 0x07) == Meta::STONE_SLAB_SMOOTH_STONE) or $id === Ids::COBBLESTONE or $id === Ids::COBBLESTONE_STAIRS or ($id === Ids::STONE_SLAB and ($meta & 0x07) == Meta::STONE_SLAB_COBBLESTONE) or $id === Ids::COBBLESTONE_WALL or $id === Ids::MOSS_STONE or ($id === Ids::STONE and $meta == Meta::STONE_ANDESITE) or ($id === Ids::STONE and $meta == Meta::STONE_POLISHED_ANDESITE) or $id === Ids::BEDROCK or $id === Ids::GOLD_ORE or $id === Ids::IRON_ORE or $id === Ids::COAL_ORE or $id === Ids::LAPIS_ORE or $id === Ids::DISPENSER or $id === Ids::DROPPER or $id === Ids::STICKY_PISTON or $id === Ids::PISTON or $id === Ids::PISTON_ARM_COLLISION or $id === Ids::MOVINGBLOCK or $id === Ids::MONSTER_SPAWNER or $id === Ids::DIAMOND_ORE or $id === Ids::FURNACE or $id === Ids::STONE_PRESSURE_PLATE or $id === Ids::REDSTONE_ORE or $id === Ids::STONE_BRICK or $id === Ids::STONE_BRICK_STAIRS or ($id === Ids::STONE_SLAB and ($meta & 0x07) == Meta::STONE_SLAB_STONE_BRICK) or $id === Ids::ENDER_CHEST or $id === Ids::HOPPER_BLOCK or $id === Ids::GRAVEL or $id === Ids::OBSERVER) {
            return new Color(112, 112, 112);
        } elseif ($id === Ids::WATER or $id === Ids::STILL_WATER or $id === Ids::FLOWING_WATER) {
            return new Color(64, 64, 255);
        } elseif (($id === Ids::LOG and ($meta & 0x03) == TreeType::OAK()->getMagicNumber()) or ($id === Ids::PLANKS and $meta == TreeType::OAK()->getMagicNumber()) or ($id === Ids::FENCE and $meta == TreeType::OAK()->getMagicNumber()) or $id === Ids::OAK_FENCE_GATE or $id === Ids::OAK_STAIRS or ($id === Ids::WOODEN_SLAB and ($meta & 0x07) == TreeType::OAK()->getMagicNumber()) or $id === Ids::NOTEBLOCK or $id === Ids::BOOKSHELF or $id === Ids::CHEST or $id === Ids::TRAPPED_CHEST or $id === Ids::CRAFTING_TABLE or $id === Ids::WOODEN_DOOR_BLOCK or $id === Ids::BIRCH_DOOR_BLOCK or $id === Ids::SPRUCE_DOOR_BLOCK or $id === Ids::JUNGLE_DOOR_BLOCK or $id === Ids::ACACIA_DOOR_BLOCK or $id === Ids::DARK_OAK_DOOR_BLOCK or $id === Ids::SIGN_POST or $id === Ids::WALL_SIGN or $id === Ids::WOODEN_PRESSURE_PLATE or $id === Ids::JUKEBOX or $id === Ids::WOODEN_TRAPDOOR or $id === Ids::BROWN_MUSHROOM_BLOCK or $id === Ids::STANDING_BANNER or $id === Ids::WALL_BANNER or $id === Ids::DAYLIGHT_SENSOR or $id === Ids::DAYLIGHT_SENSOR_INVERTED) {
            return new Color(143, 119, 72);
        } elseif ($id === Ids::QUARTZ_BLOCK or ($id === Ids::STONE_SLAB and ($meta & 0x07) == 6) or $id === Ids::QUARTZ_STAIRS or ($id === Ids::STONE and $meta == Meta::STONE_DIORITE) or ($id === Ids::STONE and $meta == Meta::STONE_POLISHED_DIORITE) or $id === Ids::SEA_LANTERN) {
            return new Color(255, 252, 245);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_ORANGE) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_ORANGE) or $id === Ids::ORANGE_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_ORANGE) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_ORANGE) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_ORANGE) or $id === Ids::PUMPKIN or $id === Ids::JACK_O_LANTERN or $id === Ids::HARDENED_CLAY or ($id === Ids::LOG2 and ($meta & 0x03) == TreeType::ACACIA()->getMagicNumber()) or ($id === Ids::PLANKS and $meta == TreeType::ACACIA()->getMagicNumber()) or ($id === Ids::FENCE and $meta == TreeType::ACACIA()->getMagicNumber()) or $id === Ids::ACACIA_FENCE_GATE or $id === Ids::ACACIA_STAIRS or ($id === Ids::WOODEN_SLAB and ($meta & 0x07) == TreeType::ACACIA()->getMagicNumber())) {
            return new Color(216, 127, 51);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_MAGENTA) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_MAGENTA) or $id === Ids::MAGENTA_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_MAGENTA) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_MAGENTA) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_MAGENTA) or $id === Ids::PURPUR_BLOCK or $id === Ids::PURPUR_STAIRS or ($id === Ids::STONE_SLAB2 and ($meta & 0x07) == Meta::STONE_SLAB2_PURPUR)) {
            return new Color(178, 76, 216);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_LIGHT_BLUE) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_LIGHT_BLUE) or $id === Ids::LIGHT_BLUE_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_LIGHT_BLUE) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_LIGHT_BLUE) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_LIGHT_BLUE)) {
            return new Color(102, 153, 216);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_YELLOW) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_YELLOW) or $id === Ids::YELLOW_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_YELLOW) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_YELLOW) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_YELLOW) or $id === Ids::HAY_BALE or $id === Ids::SPONGE) {
            return new Color(229, 229, 51);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_LIME) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_LIME) or $id === Ids::LIME_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_LIME) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_LIME) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_LIME) or $id === Ids::MELON_BLOCK) {
            return new Color(229, 229, 51);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_PINK) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_PINK) or $id === Ids::PINK_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_PINK) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_PINK) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_PINK)) {
            return new Color(242, 127, 165);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_GRAY) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_GRAY) or $id === Ids::GRAY_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_GRAY) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_GRAY) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_GRAY) or $id === Ids::CAULDRON_BLOCK) {
            return new Color(76, 76, 76);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_LIGHT_GRAY) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_LIGHT_GRAY) or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_LIGHT_GRAY) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_LIGHT_GRAY) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_LIGHT_GRAY) or $id === Ids::STRUCTURE_BLOCK) {
            return new Color(153, 153, 153);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_CYAN) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_CYAN) or $id === Ids::CYAN_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_CYAN) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_CYAN) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_CYAN) or ($id === Ids::PRISMARINE and $meta == Meta::PRISMARINE_NORMAL)) {
            return new Color(76, 127, 153);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_PURPLE) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_PURPLE) or $id === Ids::PURPLE_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_PURPLE) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_PURPLE) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_PURPLE) or $id === Ids::MYCELIUM or $id === Ids::REPEATING_COMMAND_BLOCK or $id === Ids::CHORUS_PLANT or $id === Ids::CHORUS_FLOWER) {
            return new Color(127, 63, 178);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_BLUE) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_BLUE) or $id === Ids::BLUE_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_BLUE) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_BLUE) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_BLUE)) {
            return new Color(51, 76, 178);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_BROWN) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_BROWN) or $id === Ids::BROWN_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_BROWN) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_BROWN) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_BROWN) or $id === Ids::SOUL_SAND or ($id === Ids::LOG and ($meta & 0x03) == TreeType::DARK_OAK()->getMagicNumber()) or ($id === Ids::PLANKS and $meta == TreeType::DARK_OAK()->getMagicNumber()) or ($id === Ids::FENCE and $meta == TreeType::DARK_OAK()->getMagicNumber()) or $id === Ids::DARK_OAK_FENCE_GATE or $id === Ids::DARK_OAK_STAIRS or ($id === Ids::WOODEN_SLAB and ($meta & 0x07) == TreeType::DARK_OAK()->getMagicNumber()) or $id === Ids::COMMAND_BLOCK) {
            return new Color(102, 76, 51);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_GREEN) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_GREEN) or $id === Ids::GREEN_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_GREEN) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_GREEN) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_GREEN) or $id === Ids::END_PORTAL_FRAME or $id === Ids::CHAIN_COMMAND_BLOCK) {
            return new Color(102, 127, 51);
        } elseif (($id === Ids::CONCRETE and $meta == self::COLOR_BLOCK_RED) or ($id === Ids::CONCRETE_POWDER and $meta == self::COLOR_BLOCK_RED) or $id === Ids::RED_GLAZED_TERRACOTTA or ($id === Ids::WOOL and $meta == self::COLOR_BLOCK_RED) or ($id === Ids::CARPET and $meta == self::COLOR_BLOCK_RED) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == self::COLOR_BLOCK_RED) or $id === Ids::RED_MUSHROOM_BLOCK or $id === Ids::BRICK_BLOCK or ($id === Ids::STONE_SLAB and ($meta & 0x07) == 4) or $id === Ids::BRICK_STAIRS or $id === Ids::ENCHANTING_TABLE or $id === Ids::NETHER_WART_BLOCK or $id === Ids::NETHER_WART_PLANT) {
            return new Color(153, 51, 51);
        } elseif (($id === Ids::WOOL and $meta == 0) or ($id === Ids::CARPET and $meta == 0) or ($id === Ids::STAINED_HARDENED_CLAY and $meta == 0) or $id === Ids::DRAGON_EGG or $id === Ids::COAL_BLOCK or $id === Ids::OBSIDIAN or $id === Ids::END_PORTAL) {
            return new Color(25, 25, 25);
        } elseif ($id === Ids::GOLD_BLOCK or $id === Ids::LIGHT_WEIGHTED_PRESSURE_PLATE) {
            return new Color(250, 238, 77);
        } elseif ($id === Ids::DIAMOND_BLOCK or ($id === Ids::PRISMARINE and $meta == Meta::PRISMARINE_DARK) or ($id === Ids::PRISMARINE and $meta == Meta::PRISMARINE_BRICKS) or $id === Ids::BEACON) {
            return new Color(92, 219, 213);
        } elseif ($id === Ids::LAPIS_BLOCK) {
            return new Color(74, 128, 255);
        } elseif ($id === Ids::EMERALD_BLOCK) {
            return new Color(0, 217, 58);
        } elseif ($id === Ids::PODZOL or ($id === Ids::WOOD and ($meta & 0x03) == TreeType::SPRUCE()->getMagicNumber()) or ($id === Ids::PLANKS and $meta == TreeType::SPRUCE()->getMagicNumber()) or ($id === Ids::FENCE and $meta == TreeType::SPRUCE()->getMagicNumber()) or $id === Ids::SPRUCE_FENCE_GATE or $id === Ids::SPRUCE_STAIRS or ($id === Ids::WOODEN_SLAB and ($meta & 0x07) == TreeType::SPRUCE()->getMagicNumber())) {
            return new Color(129, 86, 49);
        } elseif ($id === Ids::NETHERRACK or $id === Ids::NETHER_QUARTZ_ORE or $id === Ids::NETHER_BRICK_FENCE or $id === Ids::NETHER_BRICK_BLOCK or $id === Ids::MAGMA or $id === Ids::NETHER_BRICK_STAIRS or ($id === Ids::STONE_SLAB and ($meta & 0x07) == 7)) {
            return new Color(112, 2, 0);
        } else {
            return new Color(0, 0, 0, 0);
        }
    }
}