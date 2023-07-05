const today = new Date();

      let month=today.getMonth();
      console.log(month);
      if(month<10){month="0"+month;}

      let date=today.getDate();
      if(date<10){date="0"+date;}

      let url= "https://www.hebcal.com/converter?cfg=json&date="+today.getFullYear()+"-"+month+"-"+date+"&g2h=1&strict=1";
      console.log(month);
      console.log(url);