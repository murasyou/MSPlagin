<?php

namespace MSPlagin;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocketmine\event\Listener;

class MSPlagin extends PluginBase implements Listener
 public function onEnable()
    {
  if(!file_exists($this->getDataFolder())){//configを入れるフォルダが有るかチェック
    mkdir($this->getDataFolder(), 0744, true);//なければフォルダを作成
}
//引数1:configファイルまでの場所とconfigファイル名,引数2:configファイルのフォーマット
//引数3:configファイルに入れるデータ
$this->config = new Config($this->getDataFolder() . "SGMember.yml", Config::YAML,
array(
        'test' => 'data',
        'データ名(キー)' => '値'
        $this->config->save();
));
 if(!file_exists($this->getDataFolder())){//configを入れるフォルダが有るかチェック
    mkdir($this->getDataFolder(), 0744, true);//なければフォルダを作成
}
//引数1:configファイルまでの場所とconfigファイル名,引数2:configファイルのフォーマット
//引数3:configファイルに入れるデータ
$this->configct = new Config($this->getDataFolder() . "CTMember.yml", Config::YAML,
array(
        'test' => 'data',
        'データ名(キー)' => '値'
        $this->configct->save();
));
}
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
if ($sender instanceof Player) return $this->onCommandByUser($sender, $command, $label, $args);
        switch ($command->getName()) {
           case "gs":
                $subCommand = strtolower(array_shift($args));
                switch ($subCommand) {
                    case "":
                    case "help":
                        $sender->sendMessage("/gs kick プレイヤー");
                        $sender->sendMessage("/gs sp ");
                        $sender->sendMessage("/gs c プレイヤー");
　　　　　　　　　　　　$sender->sendMessage("/gs add プレイヤー");
                        $sender->sendMessage("/gs del プレイヤー");
                        break;

                    case "add":
                        if($sender->isOp()){
                        $target = array_shift($args);
                        $this->config->set($player, "on");//値と名前を設定
                        $this->config->save();//設定を保存
                        }else{
                        $sender->sendMessage("あなたに権限はありません");
                        }
                        break;

                    case "del":
                        if($sender->isOp()){                       
                        $target = array_shift($args);
                        $this->config->set($player, "off");//値と名前を設定
                        $this->config->save();//設定を保存
                        }else{
                        $sender->sendMessage("あなたに権限はありません");
                        }
                        break;

                    case "kick":
                        $gsk = $this->config->get($sender);
                        $target = array_shift($args);
                        if ($gsk == on){
                        $player->kick("警備員によるkick", true);//trueをfalseにすることで"警備員によるkick"と表示されなくなります
                        
                        }else{
                        $sender->sendMessage("あなたに権限はありません");
　　　　　　　　　　　　}
                        break;
                        }}}
