/* MacOS-style title bar */
.title-bar{
  height:28px;
  width:100%;
  display:flex;
  align-items:center;
  padding:0 12px;
  gap:8px;
  background:rgba(255,255,255,.2);
  border-bottom:1px solid rgba(255,255,255,.3);
  position:relative;
  overflow:hidden;
  transition:background 0.4s ease;
}
.title-bar .dot{
  width:12px;
  height:12px;
  border-radius:50%;
}
.title-bar .dot.red{background:#ff5f57;}
.title-bar .dot.yellow{background:#ffbd2e;}
.title-bar .dot.green{background:#28c840;}
/* Highlight effect */
.card:hover .title-bar{
  background: linear-gradient(90deg, rgba(0,113,227,0.15), rgba(0,113,227,0.25), rgba(0,113,227,0.15));
  animation:titleGlow 3s linear infinite;
}
@keyframes titleGlow{
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
