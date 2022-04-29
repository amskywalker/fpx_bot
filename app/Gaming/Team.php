<?php

namespace App\Gaming;

use Discord\Discord;
use Discord\Helpers\Collection;

class Team
{
    protected Discord $discord;

    public function __construct(Discord $discord)
    {
        $this->discord = $discord;
    }

    public function generate(Player $player)
    {
        if ($this->allRight($player)) {
            return $this->teamWhereHasPlayersQuantityToPosition($player);
        }
    }

    public function allRight(Player $player): bool
    {
        $players = $player->all($this->discord);
        $has_tops_quantity = $player->groupPlayersByPosition($players, 'TOP')->count() == 2;
        $has_jgs_quantity = $player->groupPlayersByPosition($players, 'JG')->count() == 2;
        $has_mids_quantity = $player->groupPlayersByPosition($players, 'MID')->count() == 2;
        $has_adcs_quantity = $player->groupPlayersByPosition($players, 'ADC')->count() == 2;
        $has_sups_quantity = $player->groupPlayersByPosition($players, 'SUP')->count() == 2;

        if (!($has_tops_quantity and $has_jgs_quantity and $has_mids_quantity and $has_adcs_quantity and $has_sups_quantity)) {
            return false;
        }
        return true;
    }

    public function teamWhereHasPlayersQuantityToPosition(Player $player): array
    {
        $players = $player->all($this->discord);

        $tops = $player->groupPlayersByPosition($players, 'TOP')->toArray();
        $jgs = $player->groupPlayersByPosition($players, 'JG')->toArray();
        $mids = $player->groupPlayersByPosition($players, 'MID')->toArray();
        $adcs = $player->groupPlayersByPosition($players, 'ADC')->toArray();
        $sups = $player->groupPlayersByPosition($players, 'SUP')->toArray();


        [$top_team_one, $top_team_two] = $this->chosenPlayer($tops);
        [$jg_team_one, $jg_team_two] = $this->chosenPlayer($jgs);
        [$mid_team_one, $mid_team_two] = $this->chosenPlayer($mids);
        [$adc_team_one, $adc_team_two] = $this->chosenPlayer($adcs);
        [$sup_team_one, $sup_team_two] = $this->chosenPlayer($sups);

        $team_one = [
            "top" => $top_team_one,
            "jg" => $jg_team_one,
            "mid" => $mid_team_one,
            "adc" => $adc_team_one,
            "sup" => $sup_team_one
        ];

        $team_two = [
            "top" => $top_team_two,
            "jg" => $jg_team_two,
            "mid" => $mid_team_two,
            "adc" => $adc_team_two,
            "sup" => $sup_team_two
        ];

        return [$team_one, $team_two];
    }

    public function chosenPlayer(array $players_by_position): array
    {
        $chosen = array_rand($players_by_position);
        $player_one = $players_by_position[$chosen];
        unset($players_by_position[$chosen]);
        $remaining_player = array_keys($players_by_position)[0];
        $player_two = $players_by_position[$remaining_player];

        return [$player_one, $player_two];
    }
}