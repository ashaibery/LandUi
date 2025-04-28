<?php

declare(strict_types=1);

namespace ashaibery\landui;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\FormAPI;
use jojoe77777\FormAPI\Form;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

// https://github.com/ashaibery

class Main extends PluginBase implements Listener
{

    public function onEnable(): void
    {
        $this->getLogger()->info("--- Plagin Enabled By ashaibery ---");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {

            case "lu" or "landui":
                if ($sender instanceof Player) {
                    $this->form($sender);
                } else {
                    $sender->sendMessage(TF::RED . "Command Just Use By Player");
                }

        }

        return true;
    }

    public function form(Player $player)
    {
        $form = new SimpleForm(function (Player $player, $data) {

            if ($data === null) {

                return true;
            }

            switch ($data) {

                case 0:
                    $command = "startp";
                    $this->getServer()->getCommandMap()->dispatch($player, $command);
                    break;
                case 1:
                    $command = "endp";
                    $this->getServer()->getCommandMap()->dispatch($player, $command);
                    break;
                case 2:
                    $command = "land buy";
                    $this->getServer()->getCommandMap()->dispatch($player, $command);
                    break;
                case 3:
                    $command = "land here";
                    $this->getServer()->getCommandMap()->dispatch($player, $command);
                    break;
                case 4:
                    $command = "land whose";
                    $this->getServer()->getCommandMap()->dispatch($player, $command);
                    break;
                case 5:
                    $this->landmove($player);
                    break;
                case 6:
                    $this->landgive($player);
                    break;
                case 7:
                    $this->landinvite($player);
                    break;
                case 8:
                    $this->landkick($player);
                    break;

            }

        });
        $form->setTitle("§g§lLand | §eUi");
        $form->setContent("§a§lYou can use the buttons below to make comfortable use  .");
        $form->addButton("§3§lStartp");
        $form->addButton("§3§lEndp");
        $form->addButton("§3§lBuy Land");
        $form->addButton("§3§lLand Here");
        $form->addButton("§3§lLand Whose");
        $form->addButton("§3§lLand Move");
        $form->addButton("§3§lLand Give Player");
        $form->addButton("§3§lLand Invite Player");
        $form->addButton("§3§lLand Kick Player");
        $form->sendToPlayer($player);
    }

    public function landmove(Player $player){
        $form = new CustomForm(function(Player $player,$data){
            if ($data === null) return true;
            $index = $data[0];

            if(is_numeric($index)){
                $cmd = $index;
                Server::getInstance()->dispatchcommand($player,"land move $cmd",true);
            }
        });

        $form->setTitle("§g§lLand Move");
        $form->addInput("§3§lType Land Number : ");

        $player->sendForm($form);
    }
    public function landgive(Player $player){
        $form = new CustomForm(function(Player $player,$data){
            if ($data === null) return true;
            $index = $data[0];
            $index2 = $data[1];

            if(is_numeric($index)){
                $cmd = $index;
                $cmd2 = $index2;
                Server::getInstance()->dispatchcommand($player,"land give $cmd $cmd2",true);
            }
        });

        $form->setTitle("§g§lLand Give");
        $form->addInput("§3§lType Player Name : ");
        $form->addInput("§3§lType Land Number : ");

        $player->sendForm($form);
    }

    public function landinvite(Player $player){
        $form = new CustomForm(function(Player $player,$data){
            if ($data === null) return true;
            $index = $data[0];
            $index2 = $data[1];

            if(is_numeric($index)){
                $cmd = $index;
                $cmd2 = $index2;
                Server::getInstance()->dispatchcommand($player,"land invite $cmd $cmd2",true);
            }
        });

        $form->setTitle("§g§lLand Invite");
        $form->addInput("§3§lType Land Number : ");
        $form->addInput("§3§lType Player Name : ");

        $player->sendForm($form);
    }

    public function landkick(Player $player){
        $form = new CustomForm(function(Player $player,$data){
            if ($data === null) return true;
            $index = $data[0];
            $index2 = $data[1];

            if(is_numeric($index)){
                $cmd = $index;
                $cmd2 = $index2;
                Server::getInstance()->dispatchcommand($player,"land kick $cmd $cmd2",true);
            }
        });

        $form->setTitle("§g§lLand kick");
        $form->addInput("§3§lType Land Number : ");
        $form->addInput("§3§lType Player Name : ");

        $player->sendForm($form);
    }

}