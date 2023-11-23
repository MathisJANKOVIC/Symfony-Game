import React, {useContext} from "react";
import { DarkModeContext } from "./contexts/DarkModeContext";

const Comp2 = () => {
    const {darkMode, toggleDarkMode} = useContext(DarkModeContext)

    const handleClick = () => {
        toggleDarkMode();
    }

    return <button onClick={handleClick}>Switch { darkMode ? "light" : "dark" }</button>
}

export default Comp2;