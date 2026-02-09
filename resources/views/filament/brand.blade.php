@once
<style>
    @keyframes gradientMove {
        0% {
            background-position: 0% 50%;
        }

        100% {
            background-position: 200% 50%;
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes glowPulse {

        0%,
        100% {
            filter: drop-shadow(0 0 0px rgba(251, 191, 36, .0));
        }

        50% {
            filter: drop-shadow(0 0 6px rgba(251, 191, 36, .35));
        }
    }

    .logo-anim {
        background: linear-gradient(90deg, #f59e0b, #fbbf24, #fde68a, #f59e0b);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientMove 6s linear infinite,
            fadeUp .7s ease-out,
            glowPulse 3s ease-in-out infinite;
    }

    @keyframes shimmerSoft {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    .subtitle-anim {
        background: linear-gradient(90deg, #9ca3af, #d1d5db, #9ca3af);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shimmerSoft 10s linear infinite, fadeUp 1s ease-out;
    }

    .logo-wrap:hover .logo-anim {
        letter-spacing: 2px;
        transform: translateY(-1px);
        transition: .25s ease;
    }

    .logo-wrap img {
        transition: .35s ease;
    }

    .logo-wrap:hover img {
        transform: scale(1.06) rotate(-2deg);
        filter: drop-shadow(0 4px 10px rgba(0, 0, 0, .18));
    }

</style>
@endonce


<div class="logo-wrap" style="display:flex; align-items:center; gap:14px; cursor:default;">

    <img src="{{ asset('images/logo.png') }}" alt="SIMPARK Logo" style="height:44px; width:auto; object-fit:contain; animation: fadeUp .6s ease-out;">

    <div style="display:flex; flex-direction:column; line-height:1.05;">

        <span class="logo-anim" style="font-size:21px; font-weight:900; letter-spacing:1px;">
            SimPark
        </span>

        <span class="subtitle-anim" style="font-size:11px; letter-spacing:1.6px;">
            Sistem Manajemen Parkir
        </span>

    </div>
</div>

