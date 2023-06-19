<!DOCTYPE html>

<HTML>
  <head>
    <?php include "utils.php"?>
    <meta name="viewport" content="minimal-ui">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $raw=zmanim(); $keys=array_keys($raw);?>

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
      try{document.getElementById('txt').innerHTML =  h + ":" + m ;}catch(err){}
      setTimeout(startTime, 1000);
    }

    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
</script>
 <body onload="initialize()" style="font-size:80px;text-align:center;margin:0px;height:100vh;">
 
 <div style='background-image:url("background2.jpg");width:100%;height:100%;margin:0px;'>
 
<div id="txt" style='background-color:white;border-radius:10px;'></div>

<div id="frame1">
  <H2 style="margin:0px;">סוף זמן קריאת שמע</H2>
  <H1 style="margin:0px;"><?php echo $raw['סוף זמן קריאת שמע ']['time'];?></H1>

  <H2 style="margin:0px;">חצות היום</H2>
  <H1 style="margin:0px;"><?php echo $raw['חצות (היום) ']['time'];?></H1>

  <H2 style="margin:0px;">שקיעת החמה</H2>
  <H1 style="margin:0px;"><?php echo $raw['שקיעת החמה (שקיעה) ']['time'];?></H1>

 
  <H2 style="margin:0px;">צאת הכוכבים</H2>
  <H1 style="margin:0px;"><?php echo $raw['לילה (צאת הכוכבים) ']['time'];?></H1>

  <H2 style="margin:0px;">חצות</H2>
  <H1 style="margin:0px;"><?php echo $raw['חצות הלילה (הלילה) ']['time'];?></H1>
</div >

</body>
</html>