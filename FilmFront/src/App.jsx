import FilmList from "./components/FilmList";
import Dock from "./components/Dock/Dock";
import { VscHome, VscArchive, VscAccount, VscSettingsGear } from "react-icons/vsc";

function App() {
  const dockItems = [
    { icon: <VscHome size={18} color="white" />, label: 'Home', onClick: () => alert('Home!') },
    { icon: <VscArchive size={18} color="white" />, label: 'Archive', onClick: () => alert('Archive!') },
    { icon: <VscAccount size={18} color="white" />, label: 'Profile', onClick: () => alert('Profile!') },
    { icon: <VscSettingsGear size={18} color="white" />, label: 'Settings', onClick: () => alert('Settings!') },
  ];

  return (
    <>
      <div className="App">
        <h1>FilmFront - Benvenuto!</h1>
        <FilmList />
      </div>

      <Dock
        items={dockItems}
        panelHeight={68}
        baseItemSize={50}
        magnification={70}
      />
    </>
  );
}

export default App;