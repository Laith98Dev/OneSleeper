<?php

namespace Laith98Dev\OneSleeper;

/*  
 *  A plugin for PocketMine-MP.
 *  
 *	 _           _ _   _    ___   ___  _____             
 *	| |         (_) | | |  / _ \ / _ \|  __ \            
 *	| |     __ _ _| |_| |_| (_) | (_) | |  | | _____   __
 *	| |    / _` | | __| '_ \__, |> _ <| |  | |/ _ \ \ / /
 *	| |___| (_| | | |_| | | |/ /| (_) | |__| |  __/\ V / 
 *	|______\__,_|_|\__|_| |_/_/  \___/|_____/ \___| \_/  
 *	
 *  Copyright (C) 2021 Laith98Dev
 *  
 *	Youtube: Laith Youtuber
 *	Discord: Laith98Dev#0695
 *	Gihhub: Laith98Dev
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 	
 */

use pocketmine\level\Level;
use pocketmine\scheduler\Task;

class SleepTask extends Task {
	
	/** @var Main */
	private $plugin;
	
	/** @var Level */
	private $level;
	
	public function __construct(Main $plugin, Level $level){
		$this->plugin = $plugin;
		$this->level = $level;
	}
	
	public function onRun(int $tick){
		$level = $this->level;
		$time = $level->getTimeOfDay();
		
		if($time >= Level::TIME_NIGHT && $time < Level::TIME_SUNRISE){
			$level->setTime($level->getTime() + Level::TIME_FULL - $time);

			foreach($level->getPlayers() as $p){
				$p->stopSleep();
			}
		}
		
		$this->getHandler()->cancel();
	}
}
