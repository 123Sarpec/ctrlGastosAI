import { buildStyles, CircularProgressbar } from 'react-circular-progressbar';
import 'react-circular-progressbar/dist/styles.css';

type Props = {
    porcentajeUsed: number;
}

export default function ProgressBar({ porcentajeUsed }: Props) {
    return (
        <div>
            <CircularProgressbar
                value={porcentajeUsed}
                styles={buildStyles({
                    pathColor: '#2a79b1ff',
                    trailColor: '#0217175b',
                    textSize: ' 8px',
                })}
                text={`${porcentajeUsed}% Gastado`}
            />
        </div>
    )
}