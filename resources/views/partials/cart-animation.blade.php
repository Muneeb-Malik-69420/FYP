{{-- ╔══════════════════════════════════════════╗ --}}
{{-- ║   EMPTY BASKET — Night scene w/ cat     ║ --}}
{{-- ╚══════════════════════════════════════════╝ --}}

<div class="ebs-scene">

  {{-- Sky --}}
  <div class="ebs-sky"></div>
  <canvas class="ebs-stars" id="ebsStars"></canvas>

  {{-- Shooting stars --}}
  <div class="ebs-shoot" style="top:22px;left:14px;animation-delay:3s;"></div>
  <div class="ebs-shoot" style="top:10px;left:70px;animation-delay:11s;"></div>

  {{-- Moon --}}
  <div class="ebs-moon-glow"></div>
  <div class="ebs-moon"></div>

  {{-- Fireflies --}}
  <div class="ebs-fly" style="left:14px;bottom:90px;--fx:-10px;--fy:-38px;animation-duration:4s;animation-delay:0s;"></div>
  <div class="ebs-fly" style="left:248px;bottom:100px;--fx:7px;--fy:-50px;animation-duration:5.5s;animation-delay:1.5s;"></div>
  <div class="ebs-fly" style="left:55px;bottom:130px;--fx:18px;--fy:-28px;animation-duration:3.8s;animation-delay:0.8s;"></div>

  {{-- Drifting food particles --}}
  <div class="ebs-particles">
    <span class="ebs-p" style="left:42%;animation-duration:4.2s;animation-delay:0s;">🐟</span>
    <span class="ebs-p" style="left:55%;animation-duration:5.1s;animation-delay:1.4s;font-size:10px;">🍗</span>
    <span class="ebs-p" style="left:35%;animation-duration:3.8s;animation-delay:2.6s;font-size:9px;">🥩</span>
    <span class="ebs-p" style="left:62%;animation-duration:4.6s;animation-delay:0.7s;font-size:8px;">✨</span>
    <span class="ebs-p" style="left:48%;animation-duration:5.5s;animation-delay:3.2s;font-size:7px;">⭐</span>
  </div>

  {{-- City windows --}}
  <div class="ebs-windows">
    <div class="ebs-win ebs-lit"                             style="height:18px;width:14px;"></div>
    <div class="ebs-win"                                     style="height:22px;"></div>
    <div class="ebs-win ebs-lit ebs-wblink"                  style="height:20px;width:16px;"></div>
    <div class="ebs-win"                                     style="height:16px;"></div>
    <div class="ebs-win ebs-lit"                             style="height:24px;width:14px;"></div>
    <div class="ebs-win"                                     style="height:20px;"></div>
    <div class="ebs-win ebs-lit"                             style="height:18px;"></div>
    <div class="ebs-win"                                     style="height:22px;width:14px;"></div>
    <div class="ebs-win ebs-lit ebs-wblink"                  style="height:16px;animation-delay:3s;"></div>
  </div>
  <div class="ebs-rooftop"></div>

  {{-- Fence --}}
  <div class="ebs-fence">
    @for($i=0;$i<18;$i++)<div class="ebs-fp"></div>@endfor
    <div class="ebs-fr"></div>
  </div>

  {{-- Ground & mat --}}
  <div class="ebs-ground"></div>
  <div class="ebs-mat"></div>

  {{-- Shadow --}}
  <div class="ebs-shadow"></div>

  {{-- Bowl --}}
  <div class="ebs-bowl-wrap">
    <svg viewBox="0 0 70 36" xmlns="http://www.w3.org/2000/svg" style="width:100%;">
      <rect class="ebs-steam" x="27" width="3" style="animation-duration:2.2s;animation-delay:0s;" rx="1.5"/>
      <rect class="ebs-steam" x="34" width="3" style="animation-duration:2.8s;animation-delay:0.7s;" rx="1.5"/>
      <rect class="ebs-steam" x="41" width="3" style="animation-duration:2.4s;animation-delay:1.4s;" rx="1.5"/>
      <ellipse cx="35" cy="34" rx="28" ry="4" fill="rgba(0,0,0,0.3)" filter="url(#ebs-bs)"/>
      <path d="M7 18 Q7 34 35 34 Q63 34 63 18 Z" fill="#9B8EC4"/>
      <path d="M13 18 Q13 29 35 29 Q57 29 57 18 Z" fill="#B8AED8"/>
      <rect x="5" y="14" width="60" height="8" rx="4" fill="#8B7DB8"/>
      <rect x="9" y="15.5" width="22" height="3" rx="1.5" fill="rgba(255,255,255,0.25)"/>
      <text x="35" y="26" text-anchor="middle" font-size="6.5" fill="rgba(255,255,255,0.4)"
            font-family="system-ui" font-weight="700" letter-spacing="0.5">EMPTY</text>
      <defs>
        <filter id="ebs-bs"><feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(0,0,0,0.4)"/></filter>
      </defs>
    </svg>
  </div>

  {{-- Cat --}}
  <div class="ebs-cat">
    <svg viewBox="0 0 130 165" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;overflow:visible;">
      <defs>
        <radialGradient id="ebs-bg" cx="45%" cy="40%" r="55%">
          <stop offset="0%" stop-color="#FFCF7A"/>
          <stop offset="100%" stop-color="#E8943A"/>
        </radialGradient>
        <radialGradient id="ebs-belly" cx="50%" cy="40%" r="55%">
          <stop offset="0%" stop-color="#FFE4A8"/>
          <stop offset="100%" stop-color="#FFCF7A"/>
        </radialGradient>
        <filter id="ebs-sg">
          <feGaussianBlur stdDeviation="2" result="blur"/>
          <feComposite in="SourceGraphic" in2="blur" operator="over"/>
        </filter>
      </defs>

      {{-- Tail --}}
      <path class="ebs-tail"
            d="M88 118 Q118 105 113 82 Q108 65 96 72 Q103 82 100 96 Q96 110 85 116 Z"
            fill="url(#ebs-bg)"/>

      {{-- Body --}}
      <g class="ebs-cbody">
        <ellipse cx="62" cy="122" rx="40" ry="34" fill="url(#ebs-bg)"/>
        <ellipse cx="62" cy="126" rx="22" ry="20" fill="url(#ebs-belly)" opacity="0.85"/>
        <path d="M54 116 Q62 112 70 116" stroke="#FFB347" stroke-width="1.2" fill="none" opacity="0.35" stroke-linecap="round"/>
        <path d="M51 122 Q62 118 73 122" stroke="#FFB347" stroke-width="1.2" fill="none" opacity="0.25" stroke-linecap="round"/>
        {{-- Paw left --}}
        <g class="ebs-pawl">
          <ellipse cx="34" cy="142" rx="11" ry="7" fill="url(#ebs-bg)"/>
          <ellipse cx="30" cy="144" rx="3.5" ry="2.5" fill="#FFCF7A"/>
          <ellipse cx="37" cy="145" rx="3.5" ry="2.5" fill="#FFCF7A"/>
          <ellipse cx="34" cy="143" rx="3" ry="2" fill="#FFCF7A"/>
        </g>
        {{-- Paw right --}}
        <ellipse cx="90" cy="142" rx="11" ry="7" fill="url(#ebs-bg)"/>
        <ellipse cx="86" cy="144" rx="3.5" ry="2.5" fill="#FFCF7A"/>
        <ellipse cx="93" cy="145" rx="3.5" ry="2.5" fill="#FFCF7A"/>
        <ellipse cx="90" cy="143" rx="3" ry="2" fill="#FFCF7A"/>
      </g>

      {{-- Head --}}
      <g class="ebs-chead">
        <circle cx="63" cy="76" r="38" fill="url(#ebs-bg)"/>
        {{-- Ears --}}
        <g class="ebs-earl"><polygon points="28,55 18,24 44,40" fill="url(#ebs-bg)"/><polygon points="30,53 22,28 41,41" fill="#FFCF7A"/></g>
        <g class="ebs-earr"><polygon points="98,55 108,24 82,40" fill="url(#ebs-bg)"/><polygon points="96,53 104,28 85,41" fill="#FFCF7A"/></g>
        {{-- Markings --}}
        <path d="M55 40 Q63 34 71 40" stroke="#E8943A" stroke-width="1.5" fill="none" opacity="0.4" stroke-linecap="round"/>
        {{-- Blush --}}
        <ellipse cx="42" cy="84" rx="12" ry="8" fill="#FFB347" opacity="0.28"/>
        <ellipse cx="84" cy="84" rx="12" ry="8" fill="#FFB347" opacity="0.28"/>
        {{-- Eyes open --}}
        <g class="ebs-eopen">
          <ellipse cx="50" cy="70" rx="9" ry="10" fill="#1a0f06"/>
          <ellipse cx="76" cy="70" rx="9" ry="10" fill="#1a0f06"/>
          <ellipse cx="50" cy="70" rx="5.5" ry="6.5" fill="#5C3D1E"/>
          <ellipse cx="76" cy="70" rx="5.5" ry="6.5" fill="#5C3D1E"/>
          <ellipse cx="50" cy="70" rx="3.5" ry="4.5" fill="#0d0703"/>
          <ellipse cx="76" cy="70" rx="3.5" ry="4.5" fill="#0d0703"/>
          <circle cx="53" cy="66" r="3" fill="white"/>
          <circle cx="79" cy="66" r="3" fill="white"/>
          <circle cx="47" cy="73" r="1.4" fill="white" opacity="0.7"/>
          <circle cx="73" cy="73" r="1.4" fill="white" opacity="0.7"/>
          <ellipse cx="55" cy="65" rx="1.5" ry="1" fill="rgba(255,240,120,0.5)" transform="rotate(-20,55,65)"/>
          <ellipse cx="81" cy="65" rx="1.5" ry="1" fill="rgba(255,240,120,0.5)" transform="rotate(-20,81,65)"/>
        </g>
        {{-- Eyes shut --}}
        <g class="ebs-eshut">
          <path d="M41 70 Q50 62 59 70" stroke="#1a0f06" stroke-width="2.8" fill="none" stroke-linecap="round"/>
          <path d="M67 70 Q76 62 85 70" stroke="#1a0f06" stroke-width="2.8" fill="none" stroke-linecap="round"/>
        </g>
        {{-- Nose & mouth --}}
        <polygon points="63,82 58,88 68,88" fill="#E8756A"/>
        <line x1="63" y1="88" x2="63" y2="93" stroke="#C0605E" stroke-width="1.4"/>
        <path d="M54,95 Q63,90 72,95" stroke="#C0605E" stroke-width="2.2" fill="none" stroke-linecap="round"/>
        {{-- Whiskers --}}
        <line x1="10" y1="82" x2="45" y2="85" stroke="#C8874A" stroke-width="1.1" stroke-linecap="round" opacity="0.6"/>
        <line x1="10" y1="89" x2="45" y2="89" stroke="#C8874A" stroke-width="1.1" stroke-linecap="round" opacity="0.6"/>
        <line x1="10" y1="96" x2="44" y2="93" stroke="#C8874A" stroke-width="1.1" stroke-linecap="round" opacity="0.6"/>
        <line x1="116" y1="82" x2="81" y2="85" stroke="#C8874A" stroke-width="1.1" stroke-linecap="round" opacity="0.6"/>
        <line x1="116" y1="89" x2="81" y2="89" stroke="#C8874A" stroke-width="1.1" stroke-linecap="round" opacity="0.6"/>
        <line x1="116" y1="96" x2="82" y2="93" stroke="#C8874A" stroke-width="1.1" stroke-linecap="round" opacity="0.6"/>
        {{-- Thought bubble --}}
        <g class="ebs-thought">
          <circle cx="102" cy="54" r="3"   fill="rgba(255,255,255,0.85)"/>
          <circle cx="114" cy="42" r="5"   fill="rgba(255,255,255,0.85)"/>
          <circle cx="128" cy="28" r="7"   fill="rgba(255,255,255,0.85)"/>
          <ellipse cx="152" cy="8" rx="24" ry="18" fill="white" opacity="0.95" filter="url(#ebs-sg)"/>
          <ellipse cx="152" cy="8" rx="24" ry="18" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
          <text x="144" y="14" font-size="20" text-anchor="middle">🍗</text>
        </g>
      </g>
    </svg>
  </div>

</div>{{-- /ebs-scene --}}

<div class="ebs-text">
  <p class="ebs-title">Nothing here yet</p>
  <p class="ebs-sub">The cat is stargazing &amp; starving.<br>Add something delicious! 🌙</p>
</div>

<style>
/* ─── Scene shell ─── */
.ebs-scene {
  position: relative; width: 100%; height: 310px;
  border-radius: 12px; overflow: hidden;
  display: flex; flex-direction: column;
  align-items: center; justify-content: flex-end;
  padding-bottom: 10px;
}
.ebs-sky {
  position:absolute; inset:0; border-radius:12px;
  background: linear-gradient(175deg,#0f0c1a 0%,#1a1035 40%,#2d1b4e 70%,#3d2060 100%);
}
.ebs-stars { position:absolute; inset:0; border-radius:12px; }

/* Shoot */
.ebs-shoot {
  position:absolute; width:55px; height:1px;
  background:linear-gradient(90deg,white,transparent);
  border-radius:1px; opacity:0;
  animation:ebsShoot 9s linear infinite;
}
@keyframes ebsShoot {
  0%  { transform:translate(0,0) rotate(-30deg);       opacity:0; }
  2%  { opacity:1; }
  6%  { transform:translate(110px,55px) rotate(-30deg); opacity:0; }
  100%{ opacity:0; }
}

/* Moon */
.ebs-moon {
  position:absolute; top:16px; right:26px;
  width:50px; height:50px; border-radius:50%;
  background:radial-gradient(circle at 35% 35%,#fffde0,#f5e87a 40%,#e8c84a);
  box-shadow:0 0 0 2px rgba(255,240,120,.15),0 0 28px rgba(255,230,80,.3),0 0 65px rgba(255,220,50,.14);
  animation:ebsMoonF 6s ease-in-out infinite;
}
.ebs-moon::after {
  content:''; position:absolute; top:8px; left:10px;
  width:9px; height:9px; border-radius:50%;
  background:rgba(0,0,0,.07);
  box-shadow:13px 5px 0 rgba(0,0,0,.05),5px 19px 0 rgba(0,0,0,.04);
}
.ebs-moon-glow {
  position:absolute; top:-2px; right:10px;
  width:82px; height:82px; border-radius:50%;
  background:radial-gradient(circle,rgba(255,230,80,.12) 0%,transparent 70%);
  animation:ebsMoonF 6s ease-in-out infinite; pointer-events:none;
}
@keyframes ebsMoonF {
  0%,100%{ transform:translateY(0) rotate(-3deg); }
  50%    { transform:translateY(-5px) rotate(3deg); }
}

/* Fireflies */
.ebs-fly {
  position:absolute; width:3px; height:3px; border-radius:50%;
  background:#a8ff78; box-shadow:0 0 6px #a8ff78,0 0 12px #a8ff78;
  animation:ebsFly ease-in-out infinite;
}
@keyframes ebsFly {
  0%  { transform:translate(0,0);             opacity:0; }
  20% { opacity:1; }
  80% { opacity:.8; }
  100%{ transform:translate(var(--fx),var(--fy)); opacity:0; }
}

/* Particles */
.ebs-particles { position:absolute; inset:0; pointer-events:none; overflow:hidden; }
.ebs-p {
  position:absolute; bottom:70px; font-size:13px;
  animation:ebsPart linear infinite; opacity:0;
}
@keyframes ebsPart {
  0%  { transform:translateY(0) rotate(0deg) scale(.8);   opacity:0; }
  10% { opacity:.7; }
  90% { opacity:.35; }
  100%{ transform:translateY(-195px) rotate(360deg) scale(1.1); opacity:0; }
}

/* Windows */
.ebs-windows {
  position:absolute; bottom:88px; left:0; right:0;
  display:flex; gap:0; justify-content:space-around; padding:0 10px;
  align-items:flex-end;
}
.ebs-win {
  width:20px; background:#2a1f3d; border-radius:3px 3px 0 0;
}
.ebs-lit { background:#ffeaa0; }
.ebs-lit::after {
  content:''; position:absolute; inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,.3) 0%,transparent 60%);
}
.ebs-wblink { animation:ebsWBlink 8s ease-in-out infinite; }
@keyframes ebsWBlink {
  0%,45%,55%,100%{ background:#ffeaa0; }
  48%,52%        { background:#2a1f3d; }
}
.ebs-rooftop {
  position:absolute; bottom:68px; left:0; right:0; height:22px;
  background:#1a1025;
}
.ebs-rooftop::before {
  content:''; position:absolute; top:-16px; left:0; right:0; height:18px;
  background:linear-gradient(to bottom,transparent,#1a1025);
}

/* Fence */
.ebs-fence {
  position:absolute; bottom:64px; left:0; right:0; height:28px;
  display:flex; align-items:flex-end; gap:3px; padding:0 10px;
}
.ebs-fp { flex:1; background:#2d1f40; border-radius:2px 2px 0 0; height:22px; }
.ebs-fp:nth-child(odd){ height:26px; }
.ebs-fr {
  position:absolute; bottom:8px; left:10px; right:10px;
  height:4px; background:#2d1f40; border-radius:2px;
}

/* Ground / mat */
.ebs-ground {
  position:absolute; bottom:0; left:0; right:0; height:66px;
  background:linear-gradient(to bottom,#1e1530,#160f28);
  border-radius:0 0 12px 12px;
}
.ebs-mat {
  position:absolute; bottom:54px; left:50%; transform:translateX(-50%);
  width:108px; height:13px; border-radius:7px;
  background:linear-gradient(90deg,#7c3aed,#a855f7,#7c3aed); opacity:.65;
}
.ebs-mat::after {
  content:''; position:absolute; inset:2px 8px; border-radius:5px;
  background:repeating-linear-gradient(90deg,rgba(255,255,255,.08) 0,rgba(255,255,255,.08) 2px,transparent 2px,transparent 6px);
}

/* Shadow */
.ebs-shadow {
  position:absolute; bottom:56px; left:50%; transform:translateX(-50%);
  width:78px; height:9px; border-radius:50%;
  background:rgba(0,0,0,.35); filter:blur(4px);
  animation:ebsShadow 2.8s ease-in-out infinite;
}
@keyframes ebsShadow {
  0%,100%{ transform:translateX(-50%) scaleX(1);    opacity:.35; }
  50%    { transform:translateX(-50%) scaleX(.78); opacity:.18; }
}

/* Bowl */
.ebs-bowl-wrap {
  position:absolute; bottom:24px; left:50%;
  transform:translateX(-50%); width:68px;
}
.ebs-steam {
  position:absolute; width:3px; border-radius:2px;
  background:rgba(255,255,255,.22); bottom:0;
  animation:ebsSteam ease-in-out infinite;
}
@keyframes ebsSteam {
  0%  { transform:translateY(0) scaleX(1);    opacity:0; height:0; }
  20% { opacity:.55; }
  100%{ transform:translateY(-20px) scaleX(2.4); opacity:0; height:13px; }
}

/* Cat */
.ebs-cat {
  position:absolute; bottom:60px; left:50%; transform:translateX(-50%);
  width:128px; height:158px;
}
/* Body bob */
.ebs-cbody,.ebs-bowl-wrap {
  animation:ebsBob 2.8s ease-in-out infinite;
}
@keyframes ebsBob {
  0%,100%{ transform:translateY(0); }
  50%    { transform:translateY(-7px); }
}
/* Head sway */
.ebs-chead {
  animation:ebsHeadSway 2.8s ease-in-out infinite;
  transform-origin:63px 94px;
}
@keyframes ebsHeadSway {
  0%,100%{ transform:translateY(0) rotate(0deg); }
  28%    { transform:translateY(-8px) rotate(-3deg); }
  65%    { transform:translateY(-6px) rotate(2.5deg); }
}
/* Tail */
.ebs-tail { transform-origin:88px 118px; animation:ebsTail 1.6s cubic-bezier(.37,0,.63,1) infinite alternate; }
@keyframes ebsTail {
  0%  { transform:rotate(-16deg); }
  100%{ transform:rotate(18deg); }
}
/* Ear twitch */
.ebs-earl { transform-origin:28px 42px; animation:ebsEarL 7s ease-in-out infinite; }
.ebs-earr { transform-origin:102px 42px; animation:ebsEarR 7s ease-in-out infinite; }
@keyframes ebsEarL { 0%,82%,100%{ transform:rotate(0); } 85%{ transform:rotate(-12deg); } 90%{ transform:rotate(0); } }
@keyframes ebsEarR { 0%,72%,100%{ transform:rotate(0); } 75%{ transform:rotate(12deg); } 80%{ transform:rotate(0); } }
/* Paw tap */
.ebs-pawl { transform-origin:28px 138px; animation:ebsPaw 2.8s ease-in-out infinite; }
@keyframes ebsPaw {
  0%,100%{ transform:rotate(0); }
  50%    { transform:rotate(-8deg) translateY(-3px); }
}
/* Blink */
.ebs-eopen { animation:ebsEO 5s step-end infinite; }
.ebs-eshut { animation:ebsES 5s step-end infinite; }
@keyframes ebsEO { 0%,90%,94%,100%{ opacity:1; } 91%,93%{ opacity:0; } }
@keyframes ebsES { 0%,90%,94%,100%{ opacity:0; } 91%,93%{ opacity:1; } }
/* Thought */
.ebs-thought { animation:ebsThought 3.4s ease-in-out infinite; }
@keyframes ebsThought {
  0%,100%{ transform:translateY(0);   opacity:1; }
  50%    { transform:translateY(-9px); opacity:.88; }
}

/* Text */
.ebs-text { text-align:center; padding:12px 16px 0; }
.ebs-title {
  font-size:10px; font-weight:900; letter-spacing:.22em;
  text-transform:uppercase; color:#00000; margin:0 0 5px;
}
.ebs-sub { font-size:12px; color:#000000; line-height:1.6; margin:0; }
</style>

<script>
(function(){
  const canvas = document.getElementById('ebsStars');
  if (!canvas) return;
  const scene = canvas.parentElement;
  function resize(){ canvas.width = scene.offsetWidth; canvas.height = scene.offsetHeight; }
  resize();
  const ctx = canvas.getContext('2d');
  const stars = Array.from({length:80}, () => ({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height * 0.72,
    r: Math.random() * 1.4 + 0.3,
    phase: Math.random() * Math.PI * 2,
    speed: Math.random() * 0.6 + 0.3,
  }));
  function draw(t){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    stars.forEach(s => {
      const a = 0.25 + 0.75*(0.5+0.5*Math.sin(s.phase + t*s.speed*0.001));
      ctx.beginPath();
      ctx.arc(s.x,s.y,s.r,0,Math.PI*2);
      ctx.fillStyle = `rgba(255,255,255,${a.toFixed(2)})`;
      ctx.fill();
    });
    requestAnimationFrame(draw);
  }
  requestAnimationFrame(draw);
  window.addEventListener('resize', resize);
})();
</script>