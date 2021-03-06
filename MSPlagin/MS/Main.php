<?php

namespace MSPlugin;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\inventory\PlayerInventory;
use pocketmine\entity\Entity;
use pocketmine\event\player\PlayerJoinEvent;


class Main extends PluginBase implements Listener{
  
 public function onEnable()
    {
	if (!file_exists($this->getDataFolder())) mkdir($this->getDataFolder(), 0744, true); 
	$this->configGS = new Config($this->getDataFolder() . "configGS.yml", Config::YAML);//ファイルを生成
        $this->configCT = new Config($this->getDataFolder() . "configCT.yml", Config::YAML);//ファイルを生成
}
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        if (!$sender instanceof Player) return false;
        switch ($command->getName()) {
           case "gs":
                $subCommand = strtolower(array_shift($args));
                switch ($subCommand) {
                    case "":
                    case "help":
                        $sender->sendMessage("/gs gkick プレイヤー");
                        $sender->sendMessage("/gs sp ");
                        $sender->sendMessage("/gs c プレイヤー");
                        $sender->sendMessage("/gs add プレイヤー");
                        $sender->sendMessage("/gs del プレイヤー");
                        break;

                    case "add":
                        if($sender->isOp()){
                        $target =  strtolower(array_shift($args));
                        $this->configGS->set($target);//値と名前を設定
                        $this->configGS->save();//設定を保存
                        $sender->sendMessage("登録完了");
                        }else{
                        $sender->sendMessage("あなたに権限はありません");
                        }
                        break;

                    case "del":
                        if($sender->isOp()){                       
                        $target =  strtolower(array_shift($args));
                        $this->configGS->remove($target);//値と名前を設定
                        $this->configGS->save();//設定を保存
                        $sender->sendMessage("削除完了");
                        }else{
                        $sender->sendMessage("あなたに権限はありません");
                        }
                        break;

                    case "kick":
			$name = array_shift($args);
			$player = Server::getInstance()->getPlayer($name);
			$splayer = Server::getInstance()->getPlayer($sender);
                        $username = $sender->getName();
            if ($this->configGS->exists("$username")){
                        $pname = $player->getName();
                        $player->kick("警備員によるkick", true);//trueをfalseにすることで"警備員によるkick"と表示されなくなります  
                        }else{
                        $sender->sendMessage("指定したMCIDがみつからない、またはあなたは権限がありません");
                    }
                        break;
                    case "c":
			$name = array_shift($args);
			$player = Server::getInstance()->getPlayer($name);
			$splayer = Server::getInstance()->getPlayer($sender);
                        $username = $sender->getName();
            if ($this->configGS->exists("$username")){
                        $pname = $player->getName();
                        $player->getInventory()->clearAll();
                        $sender->sendMessage("インベントリー削除完了");
                        }else{
                        $sender->sendMessage("指定したMCIDがみつからない、またはあなたは権限がありません");
                    }
　　　　　　　　　　　break;
                    case "sp":
			$name = array_shift($args);
			$player = Server::getInstance()->getPlayer($sender);
                        $username = $sender->getName();
            if ($this->configGS->exists("$username")){
        $player->sendMessage("鉄装備を着用しました");
        $player->getInventory()->setArmorItem(0,Item::get(306,0,1));//ヘルメット
        $player->getInventory()->setArmorItem(1,Item::get(307,0,1));//チェストプレート
        $player->getInventory()->setArmorItem(2,Item::get(308,0,1));//レギンス
        $player->getInventory()->setArmorItem(3,Item::get(309,0,1));//ブーツ
        $player->getInventory()->sendArmorContents($player);//ここで装備を着用させる
                        }else{
                        $sender->sendMessage("指定したMCIDがみつからない、またはあなたは権限がありません");
                    }

                        break;

                    }
                }
            }
        }