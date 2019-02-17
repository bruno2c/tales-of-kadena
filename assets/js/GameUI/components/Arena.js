import React from 'react'
import EnemyContainer from "../containers/EnemyContainer";

const Arena = ({ arena }) => (
    <div>
        {Object.keys(arena.enemies).map(key => (
            <EnemyContainer key={key} enemy={arena.enemies[key]} />
        ))}
    </div>
)

export default Arena