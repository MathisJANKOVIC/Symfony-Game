import React, { useContext } from "react";
import { DarkModeContext } from "./contexts/DarkModeContext";

const Comp1 = () => {
    const {darkMode} = useContext(DarkModeContext)

    return <div className={darkMode ? `container container-dark` : `container container-light`}>
        Compte 1
    </div>
}

export default Comp1;