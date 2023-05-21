# 英雄遊戲描述

- 1.class Character
    - 用來創建腳色, 可以用contruct建立屬性值
    
    - public function statusReturn()屬性值可以儲存陣列返回  用來列印戰鬥狀態
    
    - public function getHP()    public function getSpeed()
        
        可以透過函數取得hp speed  
        
        這是後面我battleScene class會用到的邏輯判斷參數(因為我屬性值是設定為protected  用function取得參數)
        
    
    - public function progressBar()
        
        每一個腳色都可以根據速度更新進度條
        
    
    - public function progressBarRenew()
        
        進度條在攻擊完之後可以做更新
        
    
    - public function beAttacked($attack)
        
        角色被攻擊可以做扣血動作
        
- 2.trait heroAttack(給英雄的)
    
    	這裡我做了一個可以根據不同種類攻擊做分類的trait  
    
    	而使用哪個攻擊是隨機的
    
- 3.class Hero extends Character
    - 這裡我創建了一個英雄class  目的是我可以在這裡增加英雄獨有的屬性(這裡我是多了魔法攻擊的判斷)
    - public function getattackJudgment()
        
         用來給後面戰鬥判斷用的取得屬性值的功能
        
    
- 4.class Monster extends Character
    
    	這裡怪物我只寫一個攻擊功能
    
    	public function beFired  …這裡因為被魔法攻擊的我只有寫給怪物, 所以我分來這裡
    
- 5.class battleScene
    
    	我把整個戰鬥的場景包成一個class
    
    - 	$character 就是要加入戰鬥的腳色
    - 	startBattle()
        
        while迴圈   裡面就是重複列印角色狀態  進度條更新  攻擊判斷   一直到hero Hp歸零
        
    - 	printStatus()
        
        印出雙方角色目前的狀態
        
    - 	renewScene()
        
        將現在的狀態重印
        
    - move()
        
        角色進度條增加
        
    - moveJudgement()
        
        判斷進度條是否到可以行動的階段
        
    - renewMonster()
        
        如果怪物死了  重新製造怪物
        
- 6.oop在此練習的應用
    
    關於trait, interface, abstract class我有想到應用的場景, 但我覺得要繼續做下去有點複雜所以我想用描述的,說一下我的理解
    
    - **trait**
        
        今天如果我有四個角色, 分別是戰士, 法師, 史萊姆, 石巨人, 而我想要做一個武器攻擊的method是for戰士跟法師的, 我就可以做一個Hero的trait, 寫上這樣的method讓戰士跟法師USE, 就不用再那兩個類各別都寫一次
        
    - **interface**
        
         今天如果我的戰士跟法師的武器攻擊要帶有不同的附加效果(比如戰士要有一定機率暈眩效果, 法師一定機率讓對方被詛咒), 我就可以做一個HERO的interface, 讓戰士跟法師implements後在各自寫上自己的效果  
        
    - **abstract**
        
        因為我所有的角色的類都繼承自class Character, 所以假設今天我所有角色都要有普通攻擊, 我可以選擇直接在class Character就把method寫死, 但如果今天我每個角色的普功都要附加不同效果, 那我就可以用abstract class Character, 然後寫一個abstract function 是普通攻擊的, 
        
        然後不同角色在各自寫上自己要附加的效果
