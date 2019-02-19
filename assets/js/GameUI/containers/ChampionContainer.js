import { connect } from 'react-redux'
import Champion from '../components/Champion'

const mapStateToProps = (state, ownProps) => {
    return {
        champion: ownProps.champion
    }
}

const mapDispatchToProps = (dispatch, ownProps) => {
    return {}
}

const ChampionContainer = connect(
    mapStateToProps,
    mapDispatchToProps
)(Champion)

export default ChampionContainer