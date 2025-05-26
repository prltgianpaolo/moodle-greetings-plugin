<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Main file to view greetings
 *
 * @package     local_greetings
 * @copyright   2023 gianpaolo <gparlati24@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Get a localised greeting message for a user
 *
 * @param \stdClass $user
 * @return string
 */
function local_greetings_get_greeting($user) {
    if ($user == null) {
        return get_string('greetinguser', 'local_greetings');
    }

    $country = $user->country;
    switch ($country) {
        case 'ES':
            $langstr = 'greetinguseres';
            break;
        case 'AU':
            $langstr = 'greetinguserau';
            break;
        case 'FJ':
            $langstr = 'greetinguserfj';
            break;
        case 'NZ':
            $langstr = 'greetingusernz';
            break;
        case 'GB':
            $langstr = 'greetinguseruk';
            break;
        case 'US':
            $langstr = 'greetinguserus';
            break;
        case 'IT':
            $langstr = 'greetinguserit';
            break;
        default:
            $langstr = 'greetingloggedinuser';
            break;
    }
        return get_string($langstr, 'local_greetings', fullname($user));
}

/**
 * Inserisci un collegamento a index.php nel menu di navigazione della home page del sito.
 *
 * @param navigation_node $frontpage Nodo che rappresenta la home page nell'albero di navigazione.
 */
function local_greetings_extend_navigation_frontpage(navigation_node $frontpage) {
    global $USER;

    // Show link only if the user is logged in and is not a guest.
    if (isloggedin() && !isguestuser()) {
        $frontpage->add(
            get_string('pluginname', 'local_greetings'),
            new moodle_url('/local/greetings/index.php'),
            navigation_node::TYPE_CUSTOM
        );
    }
}
