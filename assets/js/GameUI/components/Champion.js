import React from 'react'

const Champion = ({ champion }) => (

    (champion.id &&
        <div className={ "champion-slot" + champion.slot }>
            <div className="health-bar">
                <div className="current" style={{
                    width: (champion.healthPercentage < 3) ? '3%'
                        : (champion.healthPercentage > 99) ? '99%'
                        : champion.healthPercentage + '%'
                }}>&nbsp;</div>
                <div className="border">&nbsp;</div>
                <span className="text">{ champion.health } / { champion.maxHealth }</span>
            </div>

            <div className={ champion.sprite }></div>
        </div>
    )
)

export default Champion