<!DOCTYPE html>

<HTML>
  <head>
    <?php include "utils.php"?>
    <meta name="viewport" content="minimal-ui">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $zmanim=zmanim(); $keys=array_keys($zmanim);?>
    <?php $raw=dailystudy(); $keys=array_keys($raw);?>
  <style>
    .frame {
      display:none;
      width:100%;
      height:100%;
      margin:0px;
      z-index:1;
      position:
      fixed;
      top: 0;
      left: 0;

    }
    .center {
      width:100%;
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
  </style>
  </head>
  <script>
    let frame = 1;
    let frames = 3;
    function initialize(){
      startTime();
      //check for updates
      setTimeout(updater, 600000);
      //shift frames
      
      setInterval(shiftframes,4000);
    }
    function updater(){
      location.reload();

    }
    function shiftframes(){
      let previousframe = frame-1;
      if (previousframe==0){previousframe = frames;}
      let previousframetext="frame"+previousframe.toString();
      let frametext="frame"+frame.toString();
      window.console.log(previousframetext+" change to "+frametext);
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
<body onload="initialize()" style="font-size:80px;text-align:center;margin:0px;height:100vh;background-image:url('background2.jpg');">
 
  <div id="overlay" style="height:100vh;width:100vw;z-index:10;display:block;position: fixed;top: 0;left: 0;">
    <div style="width:100vw;height:4vh;background-color:rgb(104,10,32);">
    </div>
    <div style="width:100vw;height:6vh;background-color:rgb(104,10,32);position:absolute;bottom:0px;">
    </div>
  </div>
    <div id="clock" style="z-index:11;width:30vw;height:6vh;background-color:white;position:absolute;bottom:50px;border-radius:10px;"></div>
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
  <div id="frame2" class="frame">
    <div class="center">
    <H2 style="margin:0px;">חומש</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Chumash with Rashi'];?></H1>

    <H2 style="margin:0px;">תהילים</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Tehilim - Psalms'];?></H1>
 
    <H2 style="margin:0px;">תניא</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Tanya'];?></H1>

    <H2 style="margin:0px;">רמב"ם - פרק אחד</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Rambam - 1 Chapter Per Day (Hebrew)'];?></H1>

    <H2 style="margin:0px;">רמב"ם שלש פרקים</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Rambam - 3 Chapter Per Day (Hebrew)'];?></H1>

    <H2 style="margin:0px;">ספר המצוות</H2>
    <H1 style="margin:0px;"><?php echo $raw['Daily Mitzvah - Sefer Hamitzvot'];?></H1>
    </div>
  </div>
  <div id="frame3" class="frame">
    <div class="center">
      <h1>hi</h1>
    </div>
  </div>
  

</body>
</html>