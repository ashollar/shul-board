<!DOCTYPE html>

<HTML>
  <head>
    <?php include "utils.php"?>
    <meta name="viewport" content="minimal-ui">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $zmanim=zmanim(); $keys=array_keys($zmanim);?>
    <?php $raw=dailystudy(); $keys=array_keys($raw);?>
  <style>
    h2{
      color:rgb(240,136,39)
    }
    .frame {
      display:none;
      width:100%;
      margin:0px;
      z-index:1;
      grid-row:2;

    }
    .clock{
      display:block;
      vertical-align: middle;
      font-size:110px;
      line-height: 70px;
      padding:20px;
      z-index:11;
      width:30vw;
      background-color:white;
      color:rgb(104,10,32);
      position:absolute;
      left: 50%;
      transform: translate(-50%, -50%);
      top:calc(100% - 140px);
      border-radius:30px;
      box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;

      
      text-align: center;
    }
    body{
      grid-template-rows: 4vh auto 8vh;
      align-items: center;
    }
  </style>
  </head>
  <script>
    let frame = 1;
    let frames = 3;
    function initialize(){
      var width = screen.width;
      var height = screen.height;
      
      startTime();
      //check for updates
      setTimeout(updater, 600000);
      //shift frames
      
      setInterval(shiftframes,6000);
    }
    function updater(){
      //location.reload();

    }
    function shiftframes(){
      let previousframe = frame-1;
      if (previousframe==0){previousframe = frames;}
      let previousframetext="frame"+previousframe.toString();
      let frametext="frame"+frame.toString();
      let currentdiv=document.getElementById(frametext);
      let previousdiv=document.getElementById(previousframetext);
       try{previousdiv.style.display="none";}catch(err){}
       try{currentdiv.style.display="block";}catch(err){}

      frame =frame+1;
      if(frame==frames+1){
        frame=1;

      }

    }
    function startTime() {
      const today = new Date();
      let h = today.getHours();
      let m = today.getMinutes();
      m = checkTime(m);
      try{document.getElementById('clock').innerHTML =  h + ":" + m ;}catch(err){}
      setTimeout(startTime, 1000);
    }

    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
  


</script>
<body onload="initialize()" style="display:grid;font-size:70px;text-align:center;margin:0px;height:100vh;background-image:url('background2.jpg');">
  
  <div style="grid-row:1;width:100vw;height:4vh;background-color:rgb(104,10,32);">
    <h1 style="color:rgb(240,136,39);margin:0px;font-size:50px; text-align:right;">ב"ה</h1>
  </div>

 

  <div id="overlay" style="height:100vh;width:100vw;z-index:10;display:block;position: fixed;top: 0;left: 0;">
    <div id="clock" class="clock"></div>
  </div>

  <div id="frame1" class="frame">

    <div class="center">
    <H2 style="margin:0px;">סוף זמן קריאת שמע</H2>
    <H1 style="margin:0px;"><?php echo $zmanim['סוף זמן קריאת שמע ']['time'];?></H1>

    <H2 style="margin:0px;">חצות היום</H2>
    <H1 style="margin:0px;"><?php echo $zmanim['חצות (היום) ']['time'];?></H1>

    <H2 style="margin:0px;">שקיעת החמה</H2>
    <H1 style="margin:0px;"><?php echo $zmanim['שקיעת החמה (שקיעה) ']['time'];?></H1>

 
    <H2 style="margin:0px;">צאת הכוכבים</H2>
    <H1 style="margin:0px;"><?php echo $zmanim['לילה (צאת הכוכבים) ']['time'];?></H1>

    <H2 style="margin:0px;">חצות</H2>
    <H1 style="margin:0px;"><?php echo $zmanim['חצות הלילה (הלילה) ']['time'];?></H1>
    </div>
  </div >
  <div id="frame2" class="frame" style="font-size:44px;">

    <H2 style="margin:0px;">חומש</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Chumash with Rashi'];?></H1>

    <H2 style="margin:0px;">תהילים</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Tehilim - Psalms'];?></H1>
 
    <H2 style="margin:0px;">תניא</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Tanya'];?></H1>

    <H2 style="margin:0px;">רמב"ם - פרק אחד</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Rambam - 1 Chapter Per Day (Hebrew)'];?></H1>

    <H2 style="margin:0px;">רמב"ם שלש פרקים</H2>
    <H1 style="margin:0px;"><?php echo explode(",",$raw['Daily Rambam - 3 Chapter Per Day (Hebrew)'])[0]."<br>".explode(",",$raw['Daily Rambam - 3 Chapter Per Day (Hebrew)'])[2];?></H1>

    <H2 style="margin:0px;">ספר המצוות</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Mitzvah - Sefer Hamitzvot'];?></H1>

  </div>
  <div id="frame3" class="frame">

      <img src="rebbe.jpeg" style="width:90vw;"></img>

  </div>

  <div style="width:100vw;background-color:rgb(104,10,32);">
  </div>
  

</body>
</html>