<?php

function matchUserToGroup(string $username, array $groups, array &$matches) {
    $highest_match = 0;
    $chosen_group = null;
    $equal_groups = [];
    //Find the highest matching group for the user
    foreach ($groups as $group) {
        $match_count = getMatchingCharactersCount($username, $group['group_code']);
        if ($match_count > $highest_match) {
            $chosen_group = $group;
            $equal_groups = [];
            $highest_match = $match_count;
        } else if ($match_count === $highest_match && $match_count !== 0) {
            $equal_groups += [$chosen_group, $group];
            $chosen_group = null;
        }
    }
    //If there are equally good matches find the least populated
    if (empty($equal_groups) && !$chosen_group){
        $matches['Without Group'][] = $username;
        return ['group_code' => 'Without Group'];
    }
    if (!empty($equal_groups)) {
        $count = 9999999;
        foreach ($equal_groups as $equal_group) {
            $member_count = count($matches[$equal_group['group_code']]);
            $least_populated_groups = [];
            if ($member_count < $count) {
                $count = $member_count;
                $chosen_group = $equal_group;
                $least_populated_groups = [];
            } else if ($member_count == $count) {
                $least_populated_groups = [$chosen_group, $equal_group];
                $chosen_group = null;
            }
        }
    }
    //If there are equally populated groups, pick one randomly
    if (!empty($least_populated_groups)) {
        $chosen_group = $least_populated_groups[array_rand($least_populated_groups)];
    }
    $matches[$chosen_group['group_code']][] = $username;
    return $chosen_group;
}

function getMatchingCharactersCount(string $username, string $group_code) {
    $count = 0;
    foreach (str_split($group_code) as $letter) {
        if (strpos(strtoupper($username), strtoupper($letter))) {
            $count++;
        }
    }
    return $count;
}

function initMatches($groups) {
    $matches = [];
    foreach ($groups as $group) {
        $matches[$group['group_code']] = [];
    }
    $matches['Without Group'] = [];
    return $matches;
}