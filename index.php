<?php
$nama = isset($_GET['nama']) && trim($_GET['nama']) !== ''
    ? htmlspecialchars(trim($_GET['nama']), ENT_QUOTES, 'UTF-8')
    : 'Angle';

$dari = isset($_GET['dari']) && trim($_GET['dari']) !== ''
    ? htmlspecialchars(trim($_GET['dari']), ENT_QUOTES, 'UTF-8')
    : 'Kahfi';

$pesan = isset($_GET['pesan']) && trim($_GET['pesan']) !== ''
    ? htmlspecialchars(trim($_GET['pesan']), ENT_QUOTES, 'UTF-8')
    : 'Semoga panjang umur, sehat selalu, makin bahagia, makin kuat, dan semua hal baik yang kamu impikan bisa tercapai satu per satu.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Happy Birthday <?= $nama; ?> 🎂</title>

  <style>
    :root {
      --bg1: #140024;
      --bg2: #32105f;
      --pink: #ff5ca8;
      --gold: #ffd166;
      --cyan: #7df9ff;
      --white: #fff7fb;
      --glass: rgba(255, 255, 255, 0.13);
      --border: rgba(255, 255, 255, 0.25);
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      overflow-x: hidden;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--white);
      background:
        radial-gradient(circle at 20% 20%, rgba(255, 92, 168, .35), transparent 28%),
        radial-gradient(circle at 80% 10%, rgba(125, 249, 255, .22), transparent 30%),
        radial-gradient(circle at 50% 80%, rgba(255, 209, 102, .25), transparent 32%),
        linear-gradient(135deg, var(--bg1), var(--bg2));
    }

    canvas {
      position: fixed;
      inset: 0;
      pointer-events: none;
      z-index: 10;
    }

    .page {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 32px 16px;
      position: relative;
      z-index: 2;
    }

    .card {
      width: min(940px, 100%);
      padding: clamp(22px, 5vw, 54px);
      border: 1px solid var(--border);
      border-radius: 34px;
      background: linear-gradient(145deg, rgba(255,255,255,.18), rgba(255,255,255,.07));
      box-shadow: 0 30px 90px rgba(0,0,0,.38);
      backdrop-filter: blur(18px);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .card::before {
      content: "";
      position: absolute;
      width: 280px;
      height: 280px;
      background: radial-gradient(circle, rgba(255, 209, 102, .45), transparent 68%);
      top: -120px;
      right: -120px;
    }

    .card::after {
      content: "";
      position: absolute;
      width: 240px;
      height: 240px;
      background: radial-gradient(circle, rgba(255, 92, 168, .35), transparent 70%);
      bottom: -110px;
      left: -90px;
    }

    .content {
      position: relative;
      z-index: 2;
    }

    .badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 16px;
      border-radius: 999px;
      background: rgba(255,255,255,.14);
      border: 1px solid var(--border);
      font-size: 14px;
      margin-bottom: 18px;
    }

    h1 {
      font-size: clamp(42px, 8vw, 88px);
      line-height: .95;
      letter-spacing: -3px;
      margin-bottom: 14px;
      text-shadow: 0 0 28px rgba(255, 92, 168, .55);
    }

    .name {
      display: block;
      color: var(--gold);
      filter: drop-shadow(0 0 18px rgba(255, 209, 102, .48));
    }

    .subtitle {
      max-width: 720px;
      margin: 0 auto;
      font-size: clamp(16px, 2.3vw, 22px);
      line-height: 1.7;
      color: rgba(255,255,255,.88);
    }

    .cake {
      font-size: clamp(70px, 13vw, 128px);
      margin: 20px 0 8px;
      animation: floatCake 3s ease-in-out infinite;
      filter: drop-shadow(0 18px 28px rgba(0,0,0,.28));
    }

    @keyframes floatCake {
      0%, 100% {
        transform: translateY(0) rotate(-1deg);
      }

      50% {
        transform: translateY(-12px) rotate(1deg);
      }
    }

    .wish-box {
      margin: 26px auto 0;
      max-width: 760px;
      padding: 22px;
      border-radius: 26px;
      background: rgba(0,0,0,.18);
      border: 1px solid rgba(255,255,255,.18);
      font-size: clamp(15px, 2vw, 19px);
      line-height: 1.7;
    }

    .from {
      margin-top: 14px;
      color: var(--cyan);
      font-weight: 700;
    }

    .actions {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 14px;
      margin-top: 30px;
    }

    button {
      border: 0;
      outline: 0;
      cursor: pointer;
      color: #21072d;
      font-weight: 800;
      padding: 14px 20px;
      border-radius: 999px;
      background: linear-gradient(135deg, var(--gold), #ff9f1c);
      box-shadow: 0 14px 28px rgba(255, 209, 102, .22);
      transition: .2s ease;
      font-size: 15px;
    }

    button.secondary {
      color: var(--white);
      background: rgba(255,255,255,.14);
      border: 1px solid var(--border);
      box-shadow: none;
    }

    button:hover {
      transform: translateY(-3px) scale(1.02);
    }

    .hint {
      margin-top: 16px;
      color: rgba(255,255,255,.65);
      font-size: 13px;
    }

    .balloon {
      position: fixed;
      bottom: -130px;
      width: 58px;
      height: 72px;
      border-radius: 50% 50% 45% 45%;
      opacity: .82;
      z-index: 1;
      animation: fly 9s linear infinite;
    }

    .balloon::after {
      content: "";
      position: absolute;
      width: 2px;
      height: 76px;
      background: rgba(255,255,255,.4);
      left: 50%;
      top: 70px;
    }

    .b1 {
      left: 8%;
      background: #ff5ca8;
      animation-delay: 0s;
    }

    .b2 {
      left: 22%;
      background: #ffd166;
      animation-delay: 1.8s;
      width: 48px;
      height: 62px;
    }

    .b3 {
      left: 74%;
      background: #7df9ff;
      animation-delay: .8s;
    }

    .b4 {
      left: 88%;
      background: #b388ff;
      animation-delay: 3s;
      width: 50px;
      height: 64px;
    }

    @keyframes fly {
      0% {
        transform: translateY(0) rotate(0deg);
      }

      100% {
        transform: translateY(-125vh) rotate(18deg);
      }
    }

    .sparkle {
      position: fixed;
      width: 5px;
      height: 5px;
      background: white;
      border-radius: 50%;
      box-shadow: 0 0 14px white;
      opacity: .65;
      animation: blink 2.5s ease-in-out infinite;
      z-index: 1;
    }

    .s1 {
      top: 12%;
      left: 12%;
    }

    .s2 {
      top: 18%;
      right: 20%;
      animation-delay: .4s;
    }

    .s3 {
      bottom: 18%;
      left: 18%;
      animation-delay: .8s;
    }

    .s4 {
      bottom: 28%;
      right: 12%;
      animation-delay: 1.2s;
    }

    @keyframes blink {
      0%, 100% {
        transform: scale(.7);
        opacity: .25;
      }

      50% {
        transform: scale(1.8);
        opacity: .95;
      }
    }

    .music-status {
      margin-top: 10px;
      font-size: 13px;
      color: rgba(255,255,255,.72);
      min-height: 20px;
    }

    @media (max-width: 520px) {
      .card {
        border-radius: 26px;
      }

      h1 {
        letter-spacing: -1.5px;
      }

      .actions {
        flex-direction: column;
      }

      button {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <canvas id="confetti"></canvas>

  <div class="balloon b1"></div>
  <div class="balloon b2"></div>
  <div class="balloon b3"></div>
  <div class="balloon b4"></div>

  <div class="sparkle s1"></div>
  <div class="sparkle s2"></div>
  <div class="sparkle s3"></div>
  <div class="sparkle s4"></div>

  <main class="page">
    <section class="card">
      <div class="content">
        <div class="badge">🎉 Special Birthday Website 🎉</div>

        <h1>
          Happy Birthday
          <span class="name"><?= $nama; ?></span>
        </h1>

        <p class="subtitle">
          Hari ini adalah hari spesial untuk seseorang yang spesial.
          Semoga setiap langkahmu selalu dipenuhi kebahagiaan, keberuntungan,
          dan hal-hal indah yang datang tanpa henti.
        </p>

        <div class="cake">🎂</div>

        <div class="wish-box">
          “<?= $pesan; ?>”
          <div class="from">— Dari <?= $dari; ?> 💖</div>
        </div>

        <div class="actions">
          <button id="playBtn">▶ Putar Lagu HBD</button>
          <button class="secondary" id="surpriseBtn">🎁 Buka Surprise</button>
          <button class="secondary" id="copyBtn">🔗 Salin Link</button>
        </div>

        <div class="music-status" id="musicStatus">
          Tekan tombol putar agar musik bisa menyala di browser.
        </div>

        <p class="hint">
          Happy birthday, <?= $nama; ?>. Dari <?= $dari; ?> yang ngucapin dengan tulus.
        </p>
      </div>
    </section>
  </main>

  <script>
    const canvas = document.getElementById("confetti");
    const ctx = canvas.getContext("2d");
    const playBtn = document.getElementById("playBtn");
    const surpriseBtn = document.getElementById("surpriseBtn");
    const copyBtn = document.getElementById("copyBtn");
    const musicStatus = document.getElementById("musicStatus");

    let W, H;
    let confetti = [];

    function resize() {
      W = canvas.width = window.innerWidth;
      H = canvas.height = window.innerHeight;
    }

    window.addEventListener("resize", resize);
    resize();

    function random(min, max) {
      return Math.random() * (max - min) + min;
    }

    function makeConfetti(count = 180) {
      const colors = [
        "#ff5ca8",
        "#ffd166",
        "#7df9ff",
        "#b388ff",
        "#ffffff",
        "#7cffb2"
      ];

      for (let i = 0; i < count; i++) {
        confetti.push({
          x: random(0, W),
          y: random(-H, 0),
          r: random(4, 9),
          color: colors[Math.floor(Math.random() * colors.length)],
          speed: random(2, 6),
          drift: random(-1.5, 1.5),
          rotate: random(0, Math.PI * 2),
          spin: random(-0.08, 0.08)
        });
      }
    }

    function drawConfetti() {
      ctx.clearRect(0, 0, W, H);

      confetti.forEach((p, index) => {
        p.y += p.speed;
        p.x += p.drift;
        p.rotate += p.spin;

        ctx.save();
        ctx.translate(p.x, p.y);
        ctx.rotate(p.rotate);
        ctx.fillStyle = p.color;
        ctx.fillRect(-p.r / 2, -p.r / 2, p.r, p.r * 1.5);
        ctx.restore();

        if (p.y > H + 30) {
          confetti.splice(index, 1);
        }
      });

      requestAnimationFrame(drawConfetti);
    }

    makeConfetti(220);
    drawConfetti();

    let audioCtx;
    let isPlaying = false;

    const notes = {
      C4: 261.63,
      D4: 293.66,
      E4: 329.63,
      F4: 349.23,
      G4: 392.00,
      A4: 440.00,
      B4: 493.88,
      C5: 523.25,
      D5: 587.33,
      E5: 659.25,
      F5: 698.46,
      G5: 783.99
    };

    const melody = [
      ["G4", .35], ["G4", .22], ["A4", .55], ["G4", .55], ["C5", .55], ["B4", .9],
      ["G4", .35], ["G4", .22], ["A4", .55], ["G4", .55], ["D5", .55], ["C5", .9],
      ["G4", .35], ["G4", .22], ["G5", .55], ["E5", .55], ["C5", .55], ["B4", .55], ["A4", .95],
      ["F5", .35], ["F5", .22], ["E5", .55], ["C5", .55], ["D5", .55], ["C5", 1.15]
    ];

    function playTone(freq, start, duration, type = "sine", volume = 0.13) {
      const osc = audioCtx.createOscillator();
      const gain = audioCtx.createGain();

      osc.type = type;
      osc.frequency.setValueAtTime(freq, start);

      gain.gain.setValueAtTime(0.0001, start);
      gain.gain.exponentialRampToValueAtTime(volume, start + 0.03);
      gain.gain.exponentialRampToValueAtTime(0.0001, start + duration);

      osc.connect(gain);
      gain.connect(audioCtx.destination);

      osc.start(start);
      osc.stop(start + duration + 0.04);
    }

    function playChord(freqs, start, duration) {
      freqs.forEach(freq => {
        playTone(freq, start, duration, "triangle", 0.045);
      });
    }

    async function playBirthdaySong() {
      if (isPlaying) return;

      isPlaying = true;
      playBtn.textContent = "🎵 Lagu Sedang Diputar";
      musicStatus.textContent = "Lagu Happy Birthday sedang diputar...";

      audioCtx = new (window.AudioContext || window.webkitAudioContext)();

      let time = audioCtx.currentTime + 0.2;

      const chords = [
        [notes.C4, notes.E4, notes.G4],
        [notes.G4, notes.B4, notes.D5],
        [notes.F4, notes.A4, notes.C5],
        [notes.C4, notes.E4, notes.G4]
      ];

      let chordTime = time;

      for (let i = 0; i < 8; i++) {
        playChord(chords[i % chords.length], chordTime, 1.7);
        chordTime += 1.7;
      }

      melody.forEach(([note, dur]) => {
        playTone(notes[note], time, dur, "sine", 0.16);
        time += dur;
      });

      setTimeout(() => {
        isPlaying = false;
        playBtn.textContent = "▶ Putar Lagi HBD";
        musicStatus.textContent = "Selesai. Mau putar lagi boleh banget 🎂";
      }, Math.max(1000, (time - audioCtx.currentTime) * 1000));
    }

    playBtn.addEventListener("click", () => {
      playBirthdaySong();
      makeConfetti(180);
    });

    surpriseBtn.addEventListener("click", () => {
      makeConfetti(320);
      document.querySelector(".cake").textContent = "🎂✨";
      musicStatus.textContent = "Surprise! Semoga semua doa baiknya terkabul buat Angle 💖";
      playBirthdaySong();
    });

    copyBtn.addEventListener("click", async () => {
      try {
        await navigator.clipboard.writeText(window.location.href);
        musicStatus.textContent = "Link berhasil disalin ✅";
      } catch (e) {
        musicStatus.textContent = "Gagal salin otomatis. Copy URL dari browser ya.";
      }
    });
  </script>
</body>
</html>