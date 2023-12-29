<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap"
    />
    <style>
      body {
        margin: 0;
        line-height: normal;
      }

      :root {
        /* fonts */
        --font-inter: 'Inter', sans-serif;

        /* font sizes */
        --font-size-xs: 12px;

        /* Colors */
        --sub: #9fa5c0;
        --primary: #1fcc79;
        --e5481: #3e5481;

        /* Effects */
        --card-shadow: 0px -4px 56px rgba(0, 70, 207, 0.03);
      }

      .navigation-box {
        position: absolute;
        height: 81.9%;
        width: 100%;
        top: 18.1%;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: #fff;
        box-shadow: var(--card-shadow);
      }

      .line {
        position: absolute;
        height: 4.31%;
        width: 35.73%;
        top: 88.79%;
        right: 32.27%;
        bottom: 6.9%;
        left: 32%;
        border-radius: 100px;
        background-color: var(--e5481);
      }

      .assist-icon,
      .makeshifter-icon,
      .scan-icon,
      .profile-icon,
      .home-icon {
        position: absolute;
        height: 20.69%;
        width: 6.4%;
        top: 27.59%;
        max-width: 100%;
        overflow: hidden;
        max-height: 100%;
      }

      .assist-icon {
        left: 25.87%;
      }

      .makeshifter-icon {
        left: 67.47%;
      }

      .scan-icon {
        height: 48.28%;
        width: 14.93%;
        left: 42.67%;
        top: -2.5px;
      }

      .profile-icon {
        left: 86.67%;
      }

      .home-icon {
        left: 7.2%;
      }

      .navigation-bar {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
      }

      .navigation {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 116px;
        text-align: center;
        font-size: var(--font-size-xs);
        color: var(--sub);
      }
    </style>
  </head>

  <body>
    <div class="navigation">
      <div class="navigation-bar">
        <div class="navigation-box"></div>
        <div class="line"></div>
        <div class="assist-icon"><img alt="" src="../public/assist.svg" /></div>
        <div class="makeshifter-icon"><img alt="" src="../public/makeshifter.svg" /></div>
        <div class="scan-icon"><img alt="" src="../public/scan.svg" /></div>
        <div class="profile-icon"><img alt="" src="../public/profile.svg" /></div>
        <div class="home-icon"><img alt="" src="../public/home.svg" /></div>
      </div>
    </div>
  </body>
</html>
