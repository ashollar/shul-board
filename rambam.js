const RAMBAM_CONTENTS = {
    "Hakdama":{
        "Hakdama":3,
        "Asay":3,
        "Lo sasey":1,
        "perakim":3

    },
    "Sefer Madda": {
        "Yesodei haTorah": 10,
        "De'ot": 7,
        "Talmud Torah": 7,
        "Avodat Kochavim": 12,
        "Teshuvah": 10
    },
    "Sefer Ahavah": {
        "Kri'at Shema": 4,
        "Tefilah and Birkat Kohanim": 15,
        "Tefillin, Mezuzah and Sefer Torah": 10,
        "Tzitzit": 3,
        "Berachot": 11,
        "Milah": 3,
        "tefilos": 3
    },
    "Sefer Zemanim": {
        "Shabbat": 30,
        "Eruvin": 8,
        "Shevitat Asor": 3,
        "Shevitat Yom Tov": 8,
        "Chametz U'Matzah": 9,
        "Shofar, Sukkah, vLulav": 8,
        "Shekalim": 4,
        "Kiddush HaChodesh": 19,
        "Ta'aniyot": 5,
        "Megillah vChanukah": 4
    },
    "Sefer Nashim": {
        "Ishut": 25,
        "Gerushin": 13,
        "Yibbum vChalitzah": 8,
        "Naarah Betulah": 3,
        "Sotah": 4
    },
    "Sefer Kedushah": {"Issurei Biah": 22, "Ma'achalot Assurot": 17, "Shechitah": 14},
    "Sefer Hafla'ah": {
        "Shvuot": 12,
        "Nedarim": 13,
        "Nezirut": 10,
        "Arachim Vacharamim": 8
    },
    "Sefer Zeraim": {
        "Kilaayim": 10,
        "Matnot Aniyim": 10,
        "Terumot": 15,
        "Maaser": 14,
        "Maaser Sheini": 11,
        "Bikkurim": 12,
        "Shemita": 13
    },
    "Sefer Avodah": {
        "Beit Habechirah": 8,
        "Klei Hamikdash": 10,
        "Biat Hamikdash": 9,
        "Issurei Mizbeiach": 7,
        "Maaseh Hakorbanot": 19,
        "Temidin uMusafim": 10,
        "Pesulei Hamukdashim": 19,
        "Avodat Yom haKippurim": 5,
        "Me'ilah": 8
    },
    "Sefer Korbanot": {
        "Korban Pesach": 10,
        "Chagigah": 3,
        "Bechorot": 8,
        "Shegagot": 15,
        "Mechussarey Kapparah": 5,
        "Temurah": 4
    },
    "Sefer Taharah": {
        "Tum'at Met": 25,
        "Parah Adumah": 15,
        "Tum'at Tsara'at": 16,
        "Metamme'ey Mishkav uMoshav": 13,
        "She'ar Avot haTum'ah": 20,
        "Tum'at Okhalin": 16,
        "Kelim": 28,
        "Mikvaot": 11
    },
    "Sefer Nezikin": {
        "Hilchot Nizkei Mamon": 14,
        "Genevah": 9,
        "Gezelah va'Avedah": 18,
        "Chovel uMazzik": 8,
        "Rotzeach uShmirat Nefesh": 13
    },
    "Sefer Kinyan": {
        "Mechirah": 30,
        "Zechiyah uMattanah": 12,
        "Shechenim": 14,
        "Sheluchin veShuttafin": 10,
        "Avadim": 9
    },
    "Sefer Mishpatim": {
        "Sechirut": 13,
        "She'elah uFikkadon": 8,
        "Malveh veLoveh": 27,
        "To'en veNit'an": 16,
        "Nachalot": 11
    },
    "Sefer Shoftim": {
        "Sanhedrin veha'Onashin haMesurin lahem": 26,
        "Edut": 22,
        "Mamrim": 7,
        "Avel": 14,
        "Melachim uMilchamot": 12
    },
}
const non_perek = {
    "Hakdama":{
        1:"בשם ה",
        2:"כל אלו החכמים",
        3:"ודברים הללו"
    },
    "Asey":{
        1:"מצוות עשה",
        2:"מצווה פד",
        3:"מצווה קסז"
    },
    "Lo sasey":{
        1:"מצוות לא תעשה",
        2:"מצווה קכג",
        3:"מצווה רמה"
    },
    "perakim":{
        1:"וראיתי לחלק",
        2:"ספר קדושה",
        3:"ספר טהרה"
    },
    "tefilos":{
        1:"סדר תפלות",
        2:"נסח ברכת התפלה",
        3:"וזהו נסח כל הברכת האמצעיות",
        4:"נסח הוודוי"


    }
    
}
function rambam(date){
    var d1 = new Date("04/29/1984");   
    var d2 = new Date(date);
    var diff = d2.getTime() - d1.getTime();   
    var daydiff = diff / (1000 * 60 * 60 * 24); 
    while(daydiff > 1017){
        daydiff = daydiff-1017;

    }
    console.log(daydiff);

}
rambam(new Date(););