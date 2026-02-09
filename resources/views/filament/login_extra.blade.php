<div class="login-left">
    <h1 class="brand">SimPark</h1>

    <p class="subtitle">
        Sistem Manajemen Parkir
    </p>

    <span class="slogan">
        PARKIR TERTATA • TRANSAKSI TERJAGA
    </span>
    </div>

<style>
    /* =========================
   BACKGROUND ANIMATED
========================= */

    .fi-simple-layout {
        background: linear-gradient(-45deg, #0ea5a4, #22c1c3, #fdbb2d, #facc15);
        background-size: 300% 300%;
        animation: gradientMove 12s ease infinite;
    }

    @keyframes gradientMove {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* =========================
   FORM FLOAT IN
========================= */

    .fi-simple-main {
        position: relative;
        z-index: 2;
        animation: formFloat 0.7s cubic-bezier(.2, .8, .2, 1);
    }

    @keyframes formFloat {
        from {
            opacity: 0;
            transform: translateY(40px) scale(.96);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

   .fi-simple-main::before {
   content: "";
   position: absolute;
   inset: -30px;
   background: #0f766e;
   border-radius: 22px;
   transform: rotate(-7deg);
   z-index: -1;
   box-shadow: 0 20px 40px rgba(0,0,0,.25);
   }

   .fi-simple-main::after {
   content: "";
   position: absolute;
   inset: -55px;
   background: rgba(15,118,110,0.35);
   border-radius: 28px;
   transform: rotate(8deg);
   z-index: -2;
   opacity: .7;
   }


    /* =========================
   SHIFT FORM RIGHT
========================= */

    @media (min-width: 1024px) {
        .fi-simple-main {
            margin-left: auto !important;
            margin-right: 220px !important;
            width: 460px;
        }
    }

    /* =========================
   LEFT PANEL
========================= */

    .login-left {
        position: fixed;
        left: 80px;
        top: 50%;
        transform: translateY(-50%);
        width: 420px;
        color: #fde68a;
    }

    /* =========================
   BRAND ANIMATION
========================= */

    .brand {
    font-size: 60px;
    font-weight: 900;
    letter-spacing: 1.5px;

    /* gradient text */
    background: linear-gradient(90deg, #facc15, #fde68a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    position: relative;
    display: inline-block;

    animation: textReveal 1s ease forwards;
    }

    .brand::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -10px;
    width: 0;
    height: 6px;
    border-radius: 10px;

    background: linear-gradient(90deg, #facc15, #22c1c3);

    box-shadow: 0 4px 12px rgba(250,204,21,.4);

    animation: lineGrow 1.2s ease .9s forwards;
    }

    @keyframes lineGrow {
    from { width: 0; opacity: 0; }
    to { width: 75%; opacity: 1; }
    }



   .subtitle {
   margin-top: 22px;
   font-size: 20px;
   font-weight: 700;

   color: #fef9c3;
   letter-spacing: .4px;
   line-height: 1.3;

   opacity: 0;
   animation: textReveal 1s ease 0.3s forwards;
   }



    @keyframes textReveal {
        from {
            opacity: 0;
            transform: translateX(-30px);
            filter: blur(4px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
            filter: blur(0);
        }
    }

    /* =========================
   SLOGAN SHINE EFFECT
========================= */

  .slogan {
  display: inline-block;
  margin-top: 18px;
  font-size: 15px;
  color: #fff7ed;

  position: relative;
  overflow: hidden;

  opacity: 0;
  animation: textReveal 1s ease 0.6s forwards;
  }

    .slogan::after {
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 120%;
        height: 100%;
        background: linear-gradient(120deg,
                transparent,
                rgba(255, 255, 255, 0.6),
                transparent);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        0% {
            left: -120%;
        }

        60% {
            left: 120%;
        }

        100% {
            left: 120%;
        }
    }

    /* =========================
   MOBILE
========================= */

    @media (max-width: 1023px) {
        .login-left {
            display: none;
        }
    }

</style>

