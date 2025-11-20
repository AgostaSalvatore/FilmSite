import { VscHome, VscArchive, VscAccount, VscSettingsGear } from "react-icons/vsc";
import LiquidEther from "./components/Background/LiquidEther";
import "./App.css";

function App() {
  const dockItems = [
    { icon: <VscHome size={18} color="white" />, label: 'Home', onClick: () => alert('Home!') },
    { icon: <VscArchive size={18} color="white" />, label: 'Archive', onClick: () => alert('Archive!') },
    { icon: <VscAccount size={18} color="white" />, label: 'Profile', onClick: () => alert('Profile!') },
    { icon: <VscSettingsGear size={18} color="white" />, label: 'Settings', onClick: () => alert('Settings!') },
  ];
  return (
    <>
      <div style={{ width: '100%', height: '100vh', position: 'relative', overflow: 'hidden' }}>

        {/* Background Layer */}
        <div style={{ position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', zIndex: 0 }}>
          <LiquidEther
            colors={['#5227FF', '#FF9FFC', '#B19EEF']}
            mouseForce={20}
            cursorSize={100}
            isViscous={false}
            viscous={30}
            iterationsViscous={32}
            iterationsPoisson={32}
            resolution={0.5}
            isBounce={false}
            autoDemo={true}
            autoSpeed={0.5}
            autoIntensity={2.2}
            takeoverDuration={0.25}
            autoResumeDelay={3000}
            autoRampDuration={0.6}
          />
        </div>

        {/* Content Layer */}
        <div style={{ position: 'relative', zIndex: 1, height: '100%', overflowY: 'auto', padding: '2rem' }}>
          <h1 style={{ color: 'white', textShadow: '0 2px 4px rgba(0,0,0,0.5)' }}>FilmFront - Benvenuto!</h1>
        </div>

      </div>
    </>
  );
}

export default App;