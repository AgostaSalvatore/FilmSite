import { useNavigate } from 'react-router-dom';
import LiquidEther from "./components/LandingPage/LiquidEther";
import SplitText from "./components/LandingPage/SplitText";
import "./App.css";

function App() {
  const navigate = useNavigate();

  const handleAnimationComplete = () => {
    console.log('All letters have animated!');
  };
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
        <div style={{
          position: 'absolute',
          top: '50%',
          left: '50%',
          transform: 'translate(-50%, -50%)',
          zIndex: 1,
          pointerEvents: 'none',
          width: '100%',
          textAlign: 'center',
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
          gap: '3rem'
        }}>
          <SplitText
            text="Aura Cinema"
            className="text-white"
            delay={50}
            duration={0.8}
            ease="power3.out"
            splitType="chars"
            from={{ opacity: 0, y: 40 }}
            to={{ opacity: 1, y: 0 }}
            textAlign="center"
            tag="h1"
            onLetterAnimationComplete={handleAnimationComplete}
          />

          <button
            className="catalog-button"
            style={{ pointerEvents: 'auto' }}
            onClick={() => navigate('/films')}
          >
            <SplitText
              text="Scopri il Catalogo"
              className="button-text"
              delay={30}
              duration={0.6}
              ease="power3.out"
              splitType="chars"
              from={{ opacity: 0, y: 20 }}
              to={{ opacity: 1, y: 0 }}
              textAlign="center"
              tag="span"
            />
          </button>
        </div>

      </div>
    </>
  );
}

export default App;