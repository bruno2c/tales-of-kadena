import React from 'react'
import EnemyContainer from "../containers/EnemyContainer";
import ChampionContainer from "../containers/ChampionContainer";

const Arena = ({ arena }) => (
    <div className={"arena"}>

        <div className={"champions-side"}>
            {Object.keys(arena.champions).map(key => (
                <ChampionContainer key={key} champion={arena.champions[key]} />
            ))}
        </div>

        <div className={"enemies-side"}>
            {Object.keys(arena.enemies).map(key => (
                <EnemyContainer key={key} enemy={arena.enemies[key]} />
            ))}
        </div>
    </div>
)

export default Arena